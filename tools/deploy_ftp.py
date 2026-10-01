#!/usr/bin/env python3
"""
BAR JUNGLE - 카페24 FTP 배포

gnuboard/ 아래의 소스를 서버의 대응 경로에 올립니다.
파일을 지우지 않습니다. 올리기만 합니다. (그누보드 본체를 건드리지 않기 위함)

바뀐 파일만 올리려고 서버에 해시 목록(manifest)을 두고 비교합니다.

환경변수
  FTP_HOST / FTP_USER / FTP_PASSWORD   필수
  DEPLOY_FORCE=1                       목록을 무시하고 전부 올림
"""
import os, sys, ftplib, hashlib, json, io, socket, posixpath

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

# (로컬 경로, 서버 경로)
MAP = [
    ('gnuboard/theme/bar-jungle', '/www/theme/bar-jungle'),
    ('gnuboard/adm',              '/www/adm'),
    ('gnuboard/extend',           '/www/extend'),
]
MANIFEST = '/www/data/.deploy-manifest.json'
SKIP_NAMES = {'.DS_Store', 'Thumbs.db'}


def sha1(path):
    h = hashlib.sha1()
    with open(path, 'rb') as f:
        for chunk in iter(lambda: f.read(65536), b''):
            h.update(chunk)
    return h.hexdigest()


def load_env_file():
    """저장소 루트의 .deploy.env 에서 접속 정보를 읽습니다. (git 에 올라가지 않는 파일)"""
    path = os.path.join(ROOT, '.deploy.env')
    if not os.path.isfile(path):
        return
    with open(path, encoding='utf-8') as f:
        for line in f:
            line = line.strip()
            if not line or line.startswith('#') or '=' not in line:
                continue
            k, v = line.split('=', 1)
            k = k.strip()
            v = v.strip().strip('\'"')
            if k and k not in os.environ:
                os.environ[k] = v


def collect():
    """올릴 파일 목록 -> {서버경로: (로컬경로, 해시)}"""
    out = {}
    for local_base, remote_base in MAP:
        abs_base = os.path.join(ROOT, local_base)
        if not os.path.isdir(abs_base):
            print('건너뜀(없음): %s' % local_base)
            continue
        for dirpath, dirnames, filenames in os.walk(abs_base):
            dirnames[:] = [d for d in dirnames if not d.startswith('.')]
            for name in sorted(filenames):
                if name in SKIP_NAMES or name.startswith('.'):
                    continue
                local = os.path.join(dirpath, name)
                rel = os.path.relpath(local, abs_base).replace(os.sep, '/')
                out[posixpath.join(remote_base, rel)] = (local, sha1(local))
    return out


def ensure_dirs(ftp, remote_path, made):
    d = posixpath.dirname(remote_path)
    if d in made:
        return
    parts = d.strip('/').split('/')
    cur = ''
    for p in parts:
        cur += '/' + p
        if cur in made:
            continue
        try:
            ftp.mkd(cur)
        except ftplib.error_perm:
            pass
        made.add(cur)
    made.add(d)


def main():
    load_env_file()
    host = os.environ.get('FTP_HOST')
    user = os.environ.get('FTP_USER')
    pw = os.environ.get('FTP_PASSWORD')
    if not (host and user and pw):
        print('접속 정보가 없습니다. 저장소 루트에 .deploy.env 를 두거나')
        print('FTP_HOST / FTP_USER / FTP_PASSWORD 환경변수를 지정해 주세요.')
        return 1

    force = os.environ.get('DEPLOY_FORCE') == '1'
    files = collect()
    print('대상 파일 %d개' % len(files))

    socket.setdefaulttimeout(120)
    ftp = ftplib.FTP(host, timeout=120)
    ftp.login(user, pw)
    ftp.set_pasv(True)

    old = {}
    if not force:
        buf = io.BytesIO()
        try:
            ftp.retrbinary('RETR ' + MANIFEST, buf.write)
            old = json.loads(buf.getvalue().decode('utf-8'))
            print('이전 배포 목록 %d개 확인' % len(old))
        except Exception:
            print('이전 배포 목록 없음 (전체 업로드)')

    made = set()
    sent = skipped = 0
    for remote in sorted(files):
        local, digest = files[remote]
        if old.get(remote) == digest:
            skipped += 1
            continue
        ensure_dirs(ftp, remote, made)
        with open(local, 'rb') as f:
            ftp.storbinary('STOR ' + remote, f, blocksize=65536)
        sent += 1
        print('  올림 %s' % remote)

    manifest = {r: files[r][1] for r in files}
    ensure_dirs(ftp, MANIFEST, made)
    ftp.storbinary('STOR ' + MANIFEST, io.BytesIO(json.dumps(manifest).encode('utf-8')))

    ftp.quit()
    print('완료 : 올림 %d개 / 건너뜀 %d개' % (sent, skipped))
    return 0


if __name__ == '__main__':
    sys.exit(main())
