# BAR JUNGLE — 익선동 칵테일 바 원페이지 사이트

풀숲이 좌우로 열리며 호랑이·사자·원숭이·큰부리새·뱀이 등장하는 히어로와,
종이 질감(그레인) + 리소그래프 팔레트 기반의 종이컷 일러스트로 구성한 정적 사이트입니다.

## 실행
별도 빌드 없음. `index.html` 을 브라우저로 열면 됩니다.
(로컬 서버 예: `python3 -m http.server 8000`)

## 파일 구조
```
index.html      마크업 (SVG defs / Header / Hero / About / Signature / Menu / Moment / Visit / Footer)
css/init.css    리셋
css/layout.css  레이아웃·컴포넌트·모션·반응형 (1800/1600/1440/1280/1024/768/480)
js/lib.js       히어로 오픈 시퀀스, 스크롤 등장, 패럴랙스, 모바일 메뉴
images/         (비어 있음) 실제 사진 투입 위치
```

## 스크롤 구조 : 정글을 헤쳐나가기
- `html { scroll-snap-type: y mandatory }` + `.sec { min-height:100svh; scroll-snap-align:start }`
  → 휠·트랙패드·키보드·터치 모두 네이티브로 동작하는 풀페이지 스크롤 (스크롤 가로채기 없음)
- 섹션마다 `.sv_veil` (좌우 풀숲)이 깔려 있고, JS가 진입 진행도를 `--p` (0~1)로 계산해
  `.svv_side` 를 `translateX(calc(var(--p) * var(--vshift)))` 로 밀어냄 → 스크롤할수록 풀숲이 갈라짐
- 잎은 **한 장씩 개별 `<svg>`** 로 배치 (`.svl.n1` ~ `.svl.n22`, 좌우 22장씩)
  - 큰 SVG 하나에 몰아넣고 `preserveAspectRatio="slice"` 로 자르면 화면 한가운데
    직선으로 잘린 단면이 보이므로 쓰지 않음
  - 각 `<svg>` 는 잎 모양에 딱 맞는 viewBox + `overflow:visible` → 잘리는 곳이 없음
  - 크기는 잎의 긴 쪽 길이(vw) 기준으로 계산, `--lsc` 배율로 화면 크기에 대응
  - 오른쪽은 `scaleX(-1)` 로 미러링하고 `top:-9%` 로 어긋나게 해 대칭 티를 없앰
- 갈라지는 속도에는 **상한**이 있음 (`VEIL_DUR = 1200ms`, `js/lib.js`)
  - 천천히 스크롤 → 스크롤을 1:1로 따라옴 (손으로 헤치는 느낌)
  - 스냅으로 화면이 확 넘어가도 1.2초에 걸쳐 등속으로 갈라짐 (지수 감쇠 아님 — 초반이 빨라지지 않도록)
  - 더 느리게 하려면 `VEIL_DUR` 값을 키우면 됨
- `scroll-snap-stop: always` 로 한 번의 휠/스와이프에 한 섹션만 넘어감 (1024px 이하는 해제)
- 배경색이 위에서 아래로 점점 깊어짐:
  `#f2e9d8` → `#e5d5b6` → `#26603c` → `#17422a` → `#0d2c1c` → `#241f18`
- `#wrap::before` 비네트가 전체 스크롤 진행도(`--depth`)에 비례해 짙어짐
- 우측 `#depth` 인디케이터가 현재 층(01~06)을 표시, 밝은/어두운 섹션에 따라 색 반전
- `--p` 기본값은 `1`(열림) — JS가 죽어도 콘텐츠가 가려지지 않음
- 1024px 이하 `proximity`, 768px 이하 스냅 해제 / `prefers-reduced-motion` 시 전부 해제

## 히어로 연출 순서
1. `0.3s` 앞쪽 풀숲(`.heb_l1/.heb_r1`, `.heb_l2/.heb_r2`)이 좌우로 벌어짐 (`#hero.on`)
2. 열리기 전까지 어둠 속 눈동자(`.heb_eyes`)가 깜빡이다 사라짐
3. `1.35s~1.95s` 동물 5종이 순차 팝업 (`.hea_item` transition-delay)
4. 타이틀 → 스크롤 인디케이터 순으로 등장, 이후 잎사귀 흔들림·동물 호흡 루프
5. 동물 클릭 시 `.pop` 리액션, 스크롤 시 레이어별 패럴랙스

## 교체가 필요한 실제 정보 (현재 임시값)
- **상세 주소 / 전화번호** — `#visit` 의 `ADDRESS` 블록 (현재 "서울 종로구 익선동")
- **메뉴 구성과 가격** — `#menu` 의 `.mgl_item` (현재 예시 가격)
- **시그니처 칵테일 4종의 실제 레시피·이름** — `#signature` 의 `.sl_item`
- **영업시간** — 인스타 프로필 기준 `월–목 19:00–03:00` 만 반영, 나머지 요일 미확인
- **모먼트 사진** — `#moment` 의 `.gli_thumb` 에 `background-image:url("./images/pic_moment_01.jpg")`
  를 지정하고 내부 `<svg>` 플레이스홀더를 삭제

## 컨벤션
- CSS 한 줄 압축형, `property:value` (콜론 뒤 공백 없음), 큰따옴표, 탭 들여쓰기
- 계층적 약어 클래스: `#header` → `.h_*`, `.h_gnb` → `.hg_*` → `.hgl_*`
- 변형은 `.t1`, `.t2` … / 컬러·크기·등장은 유틸 클래스(`.cm`, `.txt.small`, `.fade.f_up`)
