# 배포

## 소스는 한 곳입니다

실제 사이트(https://jungle2304.mycafe24.com)가 쓰는 파일은 **`gnuboard/` 아래뿐**입니다.

```
gnuboard/theme/bar-jungle/   테마 (화면, CSS, JS, 이미지, 로그인 스킨)
gnuboard/adm/                관리자 페이지 (메뉴판 관리)
gnuboard/extend/             공용 정의 (탭 목록, 메뉴 조회 함수)
```

## 고치고 push 하면 올라갑니다

`git push` 할 때 `.githooks/pre-push` 가 돌면서 바뀐 파일을 카페24에 올립니다.
따로 할 일은 없습니다.

```
$ git push
[배포] 카페24에 반영 중...
대상 파일 64개
이전 배포 목록 64개 확인
  올림 /www/theme/bar-jungle/index.php
완료 : 올림 1개 / 건너뜀 63개
[배포] 완료
```

배포만 건너뛰고 push 하려면 `SKIP_DEPLOY=1 git push` 입니다.

### 새 컴퓨터에서 시작할 때

훅 경로와 접속 정보는 저장소에 들어가지 않으므로 한 번씩 잡아줘야 합니다.

```bash
git config core.hooksPath .githooks

cat > .deploy.env <<'EOF'
FTP_HOST=jungle2304.mycafe24.com
FTP_USER=jungle2304
FTP_PASSWORD=여기에_FTP_비밀번호
EOF
chmod 600 .deploy.env
```

`.deploy.env` 는 `.gitignore` 에 들어 있어 커밋되지 않습니다.

### 손으로 올리고 싶을 때

```bash
python3 tools/deploy_ftp.py                   # 바뀐 것만
DEPLOY_FORCE=1 python3 tools/deploy_ftp.py    # 전부 다시
```

## GitHub Actions 는 검사만 합니다

push 하면 Actions 가 PHP·JS·Python 문법을 검사하고, 사이트가 200 을 주는지,
메뉴가 나오는지, PHP 오류가 없는지 확인합니다. **업로드는 하지 않습니다.**

### 왜 GitHub 에서 직접 못 올리나

카페24 계정 루트의 `.ftpaccess` 에 **한국 IP 대역 2,024개만 허용**하는 설정이 걸려 있습니다.
GitHub Actions 서버는 해외라 로그인은 되지만 업로드가 `550 Operation not permitted` 로 막힙니다.

서버가 GitHub 에서 소스를 받아가게 하는 방법도 시도했으나, 원격 압축파일을 받아
풀어서 파일을 덮어쓰는 PHP 는 카페24의 웹셸 탐지에 걸려 실행 자체가 차단됩니다
(PHP 에 닿기 전에 502). 호스팅의 보안 장치라 우회하지 않았습니다.

그래서 **한국 IP 인 작업 컴퓨터에서 올리는 방식**으로 정리했습니다.

### 완전 자동이 필요하면

작업 컴퓨터에 GitHub Actions 셀프호스티드 러너를 설치하면 push 만으로 배포까지 됩니다.
다만 그 컴퓨터가 켜져 있어야 합니다. 필요하시면 설정해 드립니다.

## 배포 규칙

- **파일을 지우지 않습니다.** 올리기만 합니다. 그누보드 본체를 건드리지 않기 위해서입니다.
  서버에서 파일을 빼야 할 때는 FTP 로 직접 지웁니다.
- 바뀐 파일만 올리려고 서버 `/www/data/.deploy-manifest.json` 에 해시 목록을 둡니다.
  이 파일을 지우면 다음 배포 때 전부 다시 올라갑니다.

## 메뉴판 내용은 배포 대상이 아닙니다

메뉴 항목은 DB(`g5_jungle_menu`)에 있고 **관리자 → 정글 사이트 → 메뉴판 관리**에서 고칩니다.
시그니처 칵테일은 DB(`g5_jungle_signature`)에 따로 있고 **관리자 → 정글 사이트 → 시그니처 관리**에서 고칩니다.
저장하는 즉시 화면에 반영되며 배포와 무관합니다.

## 루트의 정적 사본

저장소 루트의 `index.html`, `css/`, `js/`, `images/` 는 그누보드로 옮기기 전에 쓰던
**정적 미리보기 사본**입니다. 실서비스와 연결돼 있지 않아 고쳐도 사이트는 바뀌지 않습니다.
GitHub Pages 링크를 살려두려고 남겨둔 것이며, 정리할지는 결정이 필요합니다.
