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
- `html { scroll-snap-type: y proximity }` + `.sec { min-height:100svh; scroll-snap-align:start }`
  → 관성 스크롤을 그대로 두고, 섹션 근처에서만 부드럽게 자리를 잡음 (스크롤 가로채기 없음)
- `scroll-snap-stop: always` 는 쓰지 않음. 관성을 매번 끊어서 스크롤이 걸리는 느낌을 줌
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

### 스크롤 성능 주의점
매 프레임 갱신되는 값은 **자식이 적은 요소에만** 써야 합니다. 커스텀 속성은 상속되므로,
쓰는 순간 그 요소의 하위 트리 전체가 스타일 재계산 대상이 됩니다.
- 숲 그늘은 `#wrap` 의 `--depth` 가 아니라, 자식 없는 `.jg_shade` 의 `opacity` 로 직접 제어
- 풀숲 진행도 `--p` 는 섹션이 아니라 실제로 움직이는 `.svv_side` 두 개에만 기록
- `will-change:transform` 은 상시가 아니라 `.sv_veil.moving` 일 때만 (레이어 10개 상시 승격 방지)
- 1024px 이하 `proximity`, 768px 이하 스냅 해제 / `prefers-reduced-motion` 시 전부 해제

## 히어로 연출 순서
1. `0.3s` 앞쪽 풀숲(`.heb_l1/.heb_r1`, `.heb_l2/.heb_r2`)이 좌우로 벌어짐 (`#hero.on`)
2. 열리기 전까지 어둠 속 눈동자(`.heb_eyes`)가 깜빡이다 사라짐
3. `1.35s~1.95s` 동물 5종이 순차 팝업 (`.hea_item` transition-delay)
4. 타이틀 → 스크롤 인디케이터 순으로 등장, 이후 잎사귀 흔들림·동물 호흡 루프
5. 동물 클릭 시 `.pop` 리액션, 스크롤 시 레이어별 패럴랙스

## 3개 국어 (KOR / ENG / JPN)
한국어 원문은 `index.html` 에 그대로 들어 있고, 다른 언어일 때만 `js/i18n.js` 의 사전으로 교체합니다.
JS 가 실패해도 한국어는 그대로 보입니다.
- 번역할 요소에 `data-i18n="키"` 를 붙이고, `js/i18n.js` 의 `en` / `ja` 에 같은 키를 추가
- 선택한 언어는 `localStorage` 에 저장, 첫 방문은 브라우저 언어로 판단
- 일본어 제목용 서체(Dela Gothic One)는 용량이 커서 일본어를 고를 때만 불러옵니다

## 교체가 필요한 실제 정보 (현재 임시값)
- **메뉴 구성과 가격** — `#menu` 의 `.mgl_item` (현재 예시. 영어·일본어 이름도 미정)
- **시그니처 칵테일 4종의 이름·레시피·사진** — `#signature` 의 `.sl_item`
- 주소·영업시간은 2026-10-01 전달받은 기획안 기준으로 반영 완료
- 모먼트 사진 6장은 실제 사진으로 교체 완료 (`images/moment/`)

## 원본 자료
`info/` (기획 PPT·로고 원본) 와 `images/real/` (원본 사진) 은 작업용 파일이라
`.gitignore` 로 저장소에서 제외했습니다. 로컬에만 있으니 백업해 두세요.

## 링크 미리보기(오픈그래프) 갱신
`tools/og-template.html` 을 1200x630 크기로 캡처해 `images/og.jpg` 로 덮어쓰면 됩니다.
```
"/Applications/Google Chrome.app/Contents/MacOS/Google Chrome" --headless=new \
  --window-size=1200,630 --virtual-time-budget=9000 \
  --screenshot=og.png tools/og-template.html
sips -s format jpeg -s formatOptions 82 og.png --out images/og.jpg && rm og.png
```
문구를 바꾸려면 템플릿의 `.txt` 블록을, 사진을 바꾸려면 `images/og_tiger.jpg` 를 교체합니다.
카카오톡·페이스북은 미리보기를 캐시하므로, 바꾼 뒤에는 각 플랫폼의 디버거에서 캐시를 비워야 반영됩니다.

## 파비콘
`images/favicon.svg` 는 林 을 폰트가 아닌 패스로 그렸습니다. CJK 폰트가 없는 환경에서도
동일하게 나옵니다. PNG(32/192/512)와 애플 터치 아이콘은 이 SVG 를 캡처해 만든 것입니다.

## 컨벤션
- CSS 한 줄 압축형, `property:value` (콜론 뒤 공백 없음), 큰따옴표, 탭 들여쓰기
- 계층적 약어 클래스: `#header` → `.h_*`, `.h_gnb` → `.hg_*` → `.hgl_*`
- 변형은 `.t1`, `.t2` … / 컬러·크기·등장은 유틸 클래스(`.cm`, `.txt.small`, `.fade.f_up`)
