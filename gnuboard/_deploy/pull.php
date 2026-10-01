<?php
/**
 * BAR JUNGLE - 배포 수신기
 *
 * 카페24는 한국 IP 에서만 FTP 업로드를 허용합니다. 그래서 GitHub Actions 가
 * 파일을 밀어 넣는 대신, 이 파일이 GitHub 에서 소스를 받아 갑니다.
 *
 * 호출 : POST  https://도메인/_deploy/pull.php
 *        헤더  X-Deploy-Token: <토큰>
 * 토큰 : /www/data/.deploy-token 파일의 내용 (저장소에는 없습니다)
 */

@set_time_limit(300);
@ini_set('memory_limit', '512M');
header('Content-Type: text/plain; charset=utf-8');

define('JG_ROOT', dirname(__DIR__));                 // /www
define('JG_REPO', 'ShinBumsun/bar-jungle');
define('JG_BRANCH', 'main');
define('JG_LOG', JG_ROOT.'/data/deploy.log');

function jg_log($msg)
{
    $line = date('Y-m-d H:i:s').' '.$msg."\n";
    @file_put_contents(JG_LOG, $line, FILE_APPEND);
    echo $msg."\n";
}

function jg_fail($msg, $code = 403)
{
    http_response_code($code);
    jg_log('실패: '.$msg);
    exit;
}

// ── 1. 토큰 확인 ────────────────────────────────────────────
$token_file = JG_ROOT.'/data/.deploy-token';
if (!is_file($token_file)) jg_fail('토큰 파일이 없습니다.');
$expected = trim(file_get_contents($token_file));
if ($expected === '') jg_fail('토큰이 비어 있습니다.');

$given = '';
if (isset($_SERVER['HTTP_X_DEPLOY_TOKEN'])) $given = trim($_SERVER['HTTP_X_DEPLOY_TOKEN']);
if ($given === '' || !hash_equals($expected, $given)) {
    jg_fail('토큰이 맞지 않습니다. (ip '.(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '?').')');
}

// ── 2. 소스 내려받기 ────────────────────────────────────────
$url = 'https://codeload.github.com/'.JG_REPO.'/zip/refs/heads/'.JG_BRANCH;
$tmp = JG_ROOT.'/data/_deploy_'.bin2hex(random_bytes(6));
$zip_path = $tmp.'.zip';

$fp = @fopen($zip_path, 'wb');
if (!$fp) jg_fail('임시 파일을 만들 수 없습니다.', 500);

$ch = curl_init($url);
curl_setopt_array($ch, array(
    CURLOPT_FILE => $fp,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_TIMEOUT => 180,
    CURLOPT_USERAGENT => 'bar-jungle-deploy',
));
$ok = curl_exec($ch);
$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err = curl_error($ch);
curl_close($ch);
fclose($fp);

if (!$ok || $http !== 200) {
    @unlink($zip_path);
    jg_fail('내려받기 실패 (http '.$http.' '.$err.')', 502);
}
jg_log('내려받음 '.number_format(filesize($zip_path)).' bytes');

// ── 3. 압축 해제 ────────────────────────────────────────────
$z = new ZipArchive();
if ($z->open($zip_path) !== true) { @unlink($zip_path); jg_fail('압축을 열 수 없습니다.', 500); }
@mkdir($tmp, 0755, true);
if (!$z->extractTo($tmp)) { $z->close(); @unlink($zip_path); jg_fail('압축 해제 실패', 500); }
$z->close();
@unlink($zip_path);

$dirs = glob($tmp.'/*', GLOB_ONLYDIR);
if (!$dirs) jg_fail('받은 소스가 비어 있습니다.', 500);
$src = $dirs[0];

// ── 4. 제자리에 복사 (지우지 않고 덮어쓰기만) ────────────────
$map = array(
    'gnuboard/theme/bar-jungle' => JG_ROOT.'/theme/bar-jungle',
    'gnuboard/adm'              => JG_ROOT.'/adm',
    'gnuboard/extend'           => JG_ROOT.'/extend',
    'gnuboard/_deploy'          => JG_ROOT.'/_deploy',
);

function jg_copy($from, $to, &$n)
{
    if (!is_dir($to)) @mkdir($to, 0755, true);
    $it = new DirectoryIterator($from);
    foreach ($it as $f) {
        if ($f->isDot()) continue;
        $name = $f->getFilename();
        if ($name[0] === '.') continue;
        if ($f->isDir()) { jg_copy($f->getPathname(), $to.'/'.$name, $n); continue; }
        if (@copy($f->getPathname(), $to.'/'.$name)) $n++;
    }
}

$total = 0;
foreach ($map as $rel => $dest) {
    $from = $src.'/'.$rel;
    if (!is_dir($from)) { jg_log('건너뜀(없음) '.$rel); continue; }
    $n = 0;
    jg_copy($from, $dest, $n);
    jg_log('복사 '.$rel.' → '.$n.'개');
    $total += $n;
}

// ── 5. 임시 폴더 정리 ───────────────────────────────────────
function jg_rmtree($dir)
{
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $f) {
        if ($f === '.' || $f === '..') continue;
        $p = $dir.'/'.$f;
        is_dir($p) ? jg_rmtree($p) : @unlink($p);
    }
    @rmdir($dir);
}
jg_rmtree($tmp);

jg_log('배포 완료: 총 '.$total.'개 파일');
echo "OK\n";
