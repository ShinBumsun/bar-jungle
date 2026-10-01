# 배포

## 소스는 한 곳입니다

실제 사이트(https://jungle2304.mycafe24.com)가 쓰는 파일은 **`gnuboard/` 아래뿐**입니다.

```
gnuboard/theme/bar-jungle/   테마 (화면, CSS, JS, 이미지)
gnuboard/adm/                관리자 페이지 (메뉴판 관리)
gnuboard/extend/             공용 정의 (탭 목록, 메뉴 조회 함수)
```

## 고치면 알아서 올라갑니다

`gnuboard/` 아래를 고쳐서 `main` 에 push 하면 GitHub Actions 가

1. 모든 PHP 파일 문법 검사
2. 바뀐 파일만 FTP 업로드
3. 사이트가 200 을 주는지, 메뉴가 나오는지, PHP 오류가 없는지 확인

까지 합니다. 하나라도 실패하면 빨간불이 뜹니다.
진행 상황은 저장소 **Actions** 탭에서 봅니다.

## 손으로 올리고 싶을 때

```bash
export FTP_HOST=jungle2304.mycafe24.com
export FTP_USER=jungle2304
export FTP_PASSWORD='...'
python3 tools/deploy_ftp.py          # 바뀐 것만
DEPLOY_FORCE=1 python3 tools/deploy_ftp.py   # 전부 다시
```

## 배포 규칙

- **파일을 지우지 않습니다.** 올리기만 합니다. 그누보드 본체를 건드리지 않기 위해서입니다.
  서버에서 파일을 빼야 할 때는 FTP 로 직접 지워야 합니다.
- 바뀐 파일만 올리려고 서버 `/www/data/.deploy-manifest.json` 에 해시 목록을 둡니다.
  이 파일을 지우면 다음 배포 때 전부 다시 올라갑니다.
- 접속 정보는 저장소 Settings → Secrets 에 `FTP_HOST` `FTP_USER` `FTP_PASSWORD` 로
  들어 있습니다. 코드에는 없습니다.

## 메뉴판 내용은 배포 대상이 아닙니다

메뉴 항목은 DB(`g5_jungle_menu`)에 있고 **관리자 → 정글 사이트 → 메뉴판 관리**에서 고칩니다.
배포와 무관하게 저장하는 즉시 화면에 반영됩니다.

## 루트의 정적 사본에 대하여

저장소 루트의 `index.html`, `css/`, `js/`, `images/` 는 그누보드로 옮기기 전에 쓰던
**정적 미리보기 사본**입니다. 실서비스와 연결돼 있지 않아 고쳐도 사이트는 바뀌지 않습니다.
GitHub Pages 미리보기 링크를 살려두려고 남겨둔 것이며, 정리할지는 결정이 필요합니다.
