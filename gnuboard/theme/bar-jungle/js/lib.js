/* BAR JUNGLE - lib.js */
(function () {
	'use strict';

	var hero = document.getElementById('hero');
	var header = document.getElementById('header');
	var toggle = document.querySelector('.h_toggle');
	var sections = document.querySelectorAll('.sec');
	var heFar = document.querySelector('.he_far');
	var heAnimals = document.querySelector('.he_animals');
	var heTitle = document.querySelector('.he_title');
	var heBush = document.querySelector('.he_bush');
	var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var wrap = document.getElementById('wrap');
	var shade = document.querySelector('.jg_shade');
	var veils = document.querySelectorAll('[data-veil]');
	var tones = document.querySelectorAll('[data-tone]');
	var depthNav = document.getElementById('depth');
	var depthItems = document.querySelectorAll('.dl_item');

	/* 히어로 오픈 : 풀숲이 열리며 동물 등장 */
	function openHero() {
		if (!hero) { return; }
		window.setTimeout(function () { hero.classList.add('on'); }, reduce ? 0 : 260);
	}
	if (document.readyState === 'complete') { openHero(); }
	else { window.addEventListener('load', openHero); }

	/* 섹션 스크롤 등장 */
	if ('IntersectionObserver' in window) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) { entry.target.classList.add('on'); }
			});
		}, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
		Array.prototype.forEach.call(sections, function (sec) { io.observe(sec); });
	} else {
		Array.prototype.forEach.call(sections, function (sec) { sec.classList.add('on'); });
	}

	/* ──────────────────────────────────────────────────────────────
	   측정값 캐시
	   스크롤 중에 getBoundingClientRect / scrollHeight 를 읽으면 그때마다
	   브라우저가 레이아웃을 다시 계산한다. 잎사귀 220개와 메뉴 208줄이
	   얹힌 이 페이지에서는 그 비용이 그대로 끊김으로 나타난다.
	   그래서 위치값은 미리 재 두고, 매 프레임에는 스크롤 위치만 읽는다.
	   ────────────────────────────────────────────────────────────── */
	var M = { vh: 0, maxScroll: 1, narrow: false, veilTop: [], toneTop: [], toneBot: [] };

	function measure() {
		var sy = window.pageYOffset || document.documentElement.scrollTop;
		var i, r;
		M.vh = window.innerHeight;
		M.narrow = window.innerWidth <= 768;
		M.maxScroll = Math.max(1, document.documentElement.scrollHeight - M.vh);
		M.veilTop = [];
		for (i = 0; i < veils.length; i++) {
			r = veils[i].getBoundingClientRect();
			M.veilTop.push(r.top + sy);
		}
		M.toneTop = []; M.toneBot = [];
		for (i = 0; i < tones.length; i++) {
			r = tones[i].getBoundingClientRect();
			M.toneTop.push(r.top + sy);
			M.toneBot.push(r.bottom + sy);
		}
	}

	/* 헤더 고정 상태 + 히어로 패럴랙스 */
	var ticking = false;
	function onScroll() {
		var sy = window.pageYOffset || document.documentElement.scrollTop;
		if (header) { header.classList.toggle('fix', sy > 60); }
		/* 패럴랙스는 큰 화면에서만. 모바일에서는 프레임당 요소 4개를 다시 그리는
		   비용이 효과보다 크다. */
		if (!reduce && !M.narrow && hero && sy < M.vh * 1.2) {
			if (heFar) { heFar.style.transform = 'translateY(' + (sy * 0.1) + 'px)'; }
			if (heBush) { heBush.style.transform = 'translateY(' + (sy * 0.16) + 'px)'; }
			if (heAnimals) { heAnimals.style.transform = 'translateY(' + (sy * 0.24) + 'px)'; }
			if (heTitle) {
				heTitle.style.transform = 'translateX(-50%) translateY(' + (sy * 0.36) + 'px)';
				heTitle.style.opacity = Math.max(0, 1 - sy / (M.vh * 0.62));
			}
		}
		updateJungle(sy);
		ticking = false;
	}

	/* 정글 헤쳐나가기 : 풀숲이 갈라지는 속도에 상한을 둠
	   - 천천히 스크롤하면 손으로 헤치듯 스크롤을 1:1로 따라옴
	   - 스냅으로 화면이 확 넘어가도 아래 시간에 걸쳐 천천히 갈라짐
	   VEIL_DUR 을 키우면 더 느려짐 (ms) */
	var VEIL_DUR = 1200;
	var veilP = [];
	var veilLast = 0;

	/* --p 를 섹션에 쓰면 섹션 전체(수백 개 노드)의 상속 변수가 매 프레임 무효화되어
	   스크롤이 버벅인다. 실제로 움직이는 좌우 풀숲에만 쓴다. */
	var veilSides = [];

	function veilTarget(i, sy) {
		var t = 1 - ((M.veilTop[i] - sy) / M.vh);
		return t < 0 ? 0 : t > 1 ? 1 : t;
	}
	function veilWrite(i, v) {
		var sides = veilSides[i], j;
		for (j = 0; j < sides.length; j++) { sides[j].style.setProperty('--p', v.toFixed(4)); }
	}

	for (var vi = 0; vi < veils.length; vi++) {
		veilSides.push(veils[vi].querySelectorAll('.svv_side'));
		veilP.push(0);
	}
	measure();
	/* 첫 프레임에 현재 스크롤 위치에 맞는 값을 반드시 한 번 써 준다.
	   (안 쓰면 --p 가 비어 있어 CSS 기본값 1 = 열린 상태로 시작해 버림) */
	(function () {
		var sy = window.pageYOffset || document.documentElement.scrollTop;
		for (var i = 0; i < veils.length; i++) {
			var t0 = reduce ? 1 : veilTarget(i, sy);
			veilP[i] = t0;
			veilWrite(i, t0);
		}
	})();

	function veilLoop(ts) {
		var dt = veilLast ? Math.min(ts - veilLast, 64) : 16;
		veilLast = ts;
		var step = dt / VEIL_DUR;
		var sy = window.pageYOffset || document.documentElement.scrollTop;
		for (var i = 0; i < veils.length; i++) {
			var target = veilTarget(i, sy);
			var cur = veilP[i];
			var diff = target - cur;
			var next = Math.abs(diff) <= step ? target : cur + (diff > 0 ? step : -step);
			if (next !== cur) {
				veilP[i] = next;
				veilWrite(i, next);
				/* 움직이는 동안에만 합성 레이어로 올린다 (상시 승격은 GPU 메모리 낭비) */
				if (!veils[i].classList.contains('moving')) { veils[i].classList.add('moving'); }
			} else if (veils[i].classList.contains('moving')) {
				veils[i].classList.remove('moving');
			}
		}
		window.requestAnimationFrame(veilLoop);
	}
	if (!reduce) { window.requestAnimationFrame(veilLoop); }

	var shadeLast = -1, toneLast = '', activeLast = -2;
	function updateJungle(sy) {
		var i;
		/* 아래로 갈수록 짙어지는 숲 그늘.
		   값을 잘게 쪼개지 않고 50단계로 끊어, 대부분의 프레임에서는 아무것도 쓰지 않는다. */
		if (shade) {
			var step = Math.round((sy / M.maxScroll) * 50);
			if (step !== shadeLast) {
				shadeLast = step;
				shade.style.opacity = (step / 50 * 0.62).toFixed(3);
			}
		}
		/* 지금 몇 번째 층인지 */
		var mid = sy + M.vh * 0.5, active = -1, tone = 'dark';
		for (i = 0; i < tones.length; i++) {
			if (M.toneTop[i] <= mid && M.toneBot[i] > mid) { active = i; tone = tones[i].getAttribute('data-tone'); }
		}
		if (depthNav && tone !== toneLast) { depthNav.classList.toggle('light', tone === 'light'); toneLast = tone; }
		if (active !== activeLast) {
			activeLast = active;
			for (i = 0; i < depthItems.length; i++) { depthItems[i].classList.toggle('on', i === active); }
		}
	}

	/* 다시 재야 하는 때
	   모바일에서 주소창이 접히고 펴지면 innerHeight 가 바뀌는데, 레이아웃이 바뀐 게
	   아니므로 무시한다. 이걸 그대로 반영하면 화면이 들썩인다. */
	var lastW = window.innerWidth, lastH = window.innerHeight, reTimer = null;
	function remeasure(delay) {
		if (reTimer) { window.clearTimeout(reTimer); }
		reTimer = window.setTimeout(function () {
			measure();
			shadeLast = -1; activeLast = -2; toneLast = '';
			onScroll();
		}, delay || 0);
	}
	window.addEventListener('resize', function () {
		var w = window.innerWidth, h = window.innerHeight;
		if (w === lastW && Math.abs(h - lastH) < 160) { lastH = h; return; }
		lastW = w; lastH = h;
		remeasure(160);
	}, { passive: true });
	window.addEventListener('orientationchange', function () { remeasure(260); }, { passive: true });
	window.addEventListener('load', function () { remeasure(0); remeasure(400); });
	if (document.fonts && document.fonts.ready && document.fonts.ready.then) {
		document.fonts.ready.then(function () { remeasure(0); });
	}
	window.jungleRemeasure = remeasure;

	window.addEventListener('scroll', function () {
		if (!ticking) { window.requestAnimationFrame(onScroll); ticking = true; }
	}, { passive: true });
	onScroll();

	/* 모바일 메뉴 */
	if (toggle) {
		toggle.addEventListener('click', function () {
			header.classList.toggle('open');
			document.body.style.overflow = header.classList.contains('open') ? 'hidden' : '';
		});
	}
	Array.prototype.forEach.call(document.querySelectorAll('.hgl_item a'), function (a) {
		a.addEventListener('click', function () {
			header.classList.remove('open');
			document.body.style.overflow = '';
		});
	});

	/* 동물 클릭 : 살짝 놀라는 리액션 */
	Array.prototype.forEach.call(document.querySelectorAll('.hea_item'), function (item) {
		item.addEventListener('click', function () {
			if (item.classList.contains('pop')) { return; }
			item.classList.add('pop');
			window.setTimeout(function () { item.classList.remove('pop'); }, 340);
		});
	});

	/* 언어 전환 : KOR / ENG / JPN
	   한국어 원문은 HTML 에 그대로 있고, 처음 로드될 때 보관해 두었다가 되돌린다. */
	/* 메뉴판 항목은 수가 많아 사전에 넣지 않고, 서버가 각 줄의 data 속성에
	   세 언어를 실어 보냅니다. 언어를 바꾸면 여기서 꺼내 씁니다. */
	var menuItems = document.querySelectorAll('[data-jm]');

	function applyMenuLang(lang) {
		/* 소분류 제목(SHOT COCKTAIL · 2샷 주문 시 할인 …)
		   번역을 적어 둔 것만 바꾸고, 없으면 한국어를 그대로 둔다.
		   VODKA·Red Wine 처럼 세 언어에서 똑같이 읽히는 제목이 대부분이다. */
		/* 탭 머리말도 같은 방식으로 바꿔 끼운다 */
		var tns = document.querySelectorAll('.mp_notice');
		for (var ni = 0; ni < tns.length; ni++) {
			var tv = tns[ni].getAttribute('data-tn-' + lang) || tns[ni].getAttribute('data-tn-ko');
			if (tv !== null) tns[ni].textContent = tv;
		}

		var subs = document.querySelectorAll('.mp_sub');
		for (var si = 0; si < subs.length; si++) {
			var sv = subs[si].getAttribute('data-ct-' + lang) || subs[si].getAttribute('data-ct-ko');
			if (sv !== null) subs[si].textContent = sv;
		}

		for (var i = 0; i < menuItems.length; i++) {
			var li = menuItems[i];
			var nameEl = li.querySelector('.mgli_name');
			if (nameEl) {
				var ja = li.getAttribute('data-nm-ja');
				var primary = (lang === 'ja' && ja) ? ja : (li.getAttribute('data-nm-ko') || '');
				var en = li.getAttribute('data-nm-en');
				var vol = li.getAttribute('data-nm-vol');
				/* 관리자가 넣은 글자가 태그로 해석되지 않도록 DOM 으로 다시 짠다 */
				nameEl.textContent = primary;
				if (en) {
					var se = document.createElement('span');
					se.textContent = en;
					nameEl.appendChild(document.createTextNode(' '));
					nameEl.appendChild(se);
				}
				if (vol) {
					var sv = document.createElement('span');
					sv.className = 'mgli_vol';
					sv.textContent = vol;
					nameEl.appendChild(document.createTextNode(' '));
					nameEl.appendChild(sv);
				}
			}
			/* 시그니처 카드는 영문명이 크게, 그 아래 한글명(일본어일 땐 일본어명)이 붙는다 */
			var sub = li.querySelector('.sli_name span');
			if (sub) {
				var ja2 = li.getAttribute('data-nm-ja');
				sub.textContent = (lang === 'ja' && ja2) ? ja2 : (li.getAttribute('data-nm-ko') || '');
			}
			var d = li.querySelector('.mgli_desc') || li.querySelector('.sli_note');
			if (d) {
				var txt = li.getAttribute('data-ds-' + lang) || '';
				d.textContent = txt;
				d.hidden = (txt === '');
			}
		}
	}

	var DICT = window.JUNGLE_I18N || {};
	var langBtns = document.querySelectorAll('.hl_btn');
	var i18nEls = document.querySelectorAll('[data-i18n]');
	var koHtml = [];
	for (var ki = 0; ki < i18nEls.length; ki++) { koHtml.push(i18nEls[ki].innerHTML); }

	function setLang(lang) {
		if (!DICT[lang]) { lang = 'ko'; }
		var dict = DICT[lang] || {}, i, key;
		for (i = 0; i < i18nEls.length; i++) {
			key = i18nEls[i].getAttribute('data-i18n');
			i18nEls[i].innerHTML = (lang === 'ko' || !dict[key]) ? koHtml[i] : dict[key];
		}
		document.documentElement.setAttribute('lang', lang);
		/* 일본어 제목용 서체는 용량이 커서, 일본어를 고를 때만 불러온다 */
		if (lang === 'ja' && !document.getElementById('ja_font')) {
			var fl = document.createElement('link');
			fl.id = 'ja_font';
			fl.rel = 'stylesheet';
			fl.href = 'https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap';
			document.head.appendChild(fl);
		}
		for (i = 0; i < langBtns.length; i++) {
			langBtns[i].classList.toggle('on', langBtns[i].getAttribute('data-lang') === lang);
		}
		applyMenuLang(lang);
		try { localStorage.setItem('jungle_lang', lang); } catch (e) {}
		/* 문구 길이가 달라지면 높이도 달라진다 */
		if (window.jungleRemeasure) { window.jungleRemeasure(0); }
	}
	for (var li = 0; li < langBtns.length; li++) {
		langBtns[li].addEventListener('click', function () { setLang(this.getAttribute('data-lang')); });
	}
	(function () {
		var saved = null;
		try { saved = localStorage.getItem('jungle_lang'); } catch (e) {}
		if (!saved) {
			var nav = (navigator.language || 'ko').toLowerCase();
			saved = nav.indexOf('ja') === 0 ? 'ja' : (nav.indexOf('ko') === 0 ? 'ko' : 'en');
		}
		if (saved !== 'ko') { setLang(saved); }
	})();

	/* 가로 슬라이드 (시그니처 카드 · 굿즈)
	   가로 스크롤 자체는 브라우저에 맡기고, 화살표와 마우스 드래그로 거든다.
	   손가락 스와이프는 브라우저 기본 동작이 가장 매끄러워서 건드리지 않는다.
	   슬라이더가 둘 이상이므로 한 덩어리로 묶어 각각에 건다. */
	function makeSlider(root) {
		var list = root.querySelector('.s_list');
		if (!list) { return; }
		var prev = root.querySelector('.ss_prev');
		var next = root.querySelector('.ss_next');
		var tick = false;

		function step() {
			var card = list.querySelector('li');
			if (!card) { return 300; }
			var cs = window.getComputedStyle(list);
			var gap = parseFloat(cs.columnGap || cs.gap) || 22;
			return card.getBoundingClientRect().width + gap;
		}
		function max() { return Math.max(0, list.scrollWidth - list.clientWidth); }
		function sync() {
			var m = max();
			if (prev) { prev.disabled = list.scrollLeft <= 2; }
			if (next) { next.disabled = list.scrollLeft >= m - 2; }
			tick = false;
		}
		function to(left, smooth) {
			left = Math.max(0, Math.min(max(), left));
			if (list.scrollTo && smooth && !reduce) { list.scrollTo({ left: left, behavior: 'smooth' }); }
			else { list.scrollLeft = left; }
		}
		function move(dir) { to(list.scrollLeft + dir * step(), true); }

		if (prev) { prev.addEventListener('click', function () { move(-1); }); }
		if (next) { next.addEventListener('click', function () { move(1); }); }

		/* 마우스 드래그
		   끄는 동안에는 스냅과 부드러운 스크롤을 꺼야 한다. 켜 둔 채로
		   scrollLeft 를 직접 쓰면 매 프레임 원래 자리로 되돌아가 버린다. */
		var dragOn = false, dragId = null, grabbed = false;
		var startX = 0, startLeft = 0, moved = 0;

		list.addEventListener('pointerdown', function (e) {
			if (e.pointerType === 'touch') { return; }	/* 스와이프는 기본 동작에 맡긴다 */
			if (e.button !== 0) { return; }
			if (max() <= 0) { return; }					/* 넘칠 게 없으면 끌 것도 없다 */
			dragOn = true; dragId = e.pointerId; grabbed = false;
			startX = e.clientX; startLeft = list.scrollLeft; moved = 0;
		});

		list.addEventListener('pointermove', function (e) {
			if (!dragOn || e.pointerId !== dragId) { return; }
			var dx = e.clientX - startX;
			if (Math.abs(dx) > Math.abs(moved)) { moved = dx; }
			if (!grabbed) {
				if (Math.abs(dx) <= 3) { return; }		/* 그냥 클릭한 건 건드리지 않는다 */
				grabbed = true;
				try { list.setPointerCapture(dragId); } catch (err) {}
				/* 스냅을 끄는 순간 위치가 살짝 틀어질 수 있어, 끈 뒤에 기준을 다시 잡는다 */
				list.classList.add('is_drag');
				startX = e.clientX; startLeft = list.scrollLeft;
				dx = 0;
			}
			list.scrollLeft = startLeft - dx;
			e.preventDefault();
		});

		function dragEnd() {
			if (!dragOn) { return; }
			dragOn = false;
			if (grabbed) { try { list.releasePointerCapture(dragId); } catch (err) {} }
			dragId = null;
			/* 스냅을 되살리기 전에 멈춘 자리를 먼저 읽는다.
			   클래스를 떼는 순간 브라우저가 알아서 당겨 버리기 때문이다. */
			var st = step(), now = list.scrollLeft;
			list.classList.remove('is_drag');
			if (!grabbed) { return; }
			/* 손을 뗀 자리에서 가장 가까운 카드로 맞춘다.
			   조금이라도 끌었으면 끈 방향으로 한 장은 넘어가게 해 준다. */
			var idx = (Math.abs(now - startLeft) > st * 0.15)
				? (now > startLeft ? Math.ceil(now / st) : Math.floor(now / st))
				: Math.round(now / st);
			to(idx * st, true);
		}
		list.addEventListener('pointerup', dragEnd);
		list.addEventListener('pointercancel', dragEnd);

		/* 끌고 난 뒤의 클릭은 삼킨다. 카드를 집어 옮긴 것이지 누른 게 아니다. */
		list.addEventListener('click', function (e) {
			if (Math.abs(moved) > 5) { e.preventDefault(); e.stopPropagation(); moved = 0; }
		}, true);
		/* 카드 안의 글자·이미지가 브라우저 기본 드래그로 끌려나오지 않게 */
		list.addEventListener('dragstart', function (e) { e.preventDefault(); });

		/* 목록에 초점이 있을 때 좌우 키 */
		list.addEventListener('keydown', function (e) {
			if (e.key === 'ArrowRight') { move(1); e.preventDefault(); }
			else if (e.key === 'ArrowLeft') { move(-1); e.preventDefault(); }
		});

		list.addEventListener('scroll', function () {
			if (!tick) { window.requestAnimationFrame(sync); tick = true; }
		}, { passive: true });
		window.addEventListener('resize', function () {
			if (!tick) { window.requestAnimationFrame(sync); tick = true; }
		}, { passive: true });

		/* 그림이 아직 안 받아진 동안에는 가로 폭이 덜 잡힌다. 그 상태로 재면
		   넘칠 게 없다고 보고 화살표를 꺼 버린 뒤 그대로 굳는다.
		   그림이 올 때마다, 그리고 다 온 뒤에 한 번 더 잰다. */
		root.jungleSync = sync;
		window.addEventListener('load', sync);
		Array.prototype.forEach.call(list.querySelectorAll('img'), function (im) {
			if (!im.complete) { im.addEventListener('load', sync); }
		});
		sync();
	}

	Array.prototype.forEach.call(document.querySelectorAll('.s_slider'), makeSlider);

	/* 메뉴 탭 : 항목이 많아 분류별로 나눠 보여 줌 */
	var tabBtns = document.querySelectorAll('.mt_btn');
	var tabPanels = document.querySelectorAll('.mp_panel');
	for (var ti = 0; ti < tabBtns.length; ti++) {
		tabBtns[ti].addEventListener('click', function () {
			var id = 'pn_' + this.getAttribute('data-panel'), i;
			for (i = 0; i < tabBtns.length; i++) {
				var on = tabBtns[i] === this;
				tabBtns[i].classList.toggle('on', on);
				tabBtns[i].setAttribute('aria-selected', on ? 'true' : 'false');
			}
			for (i = 0; i < tabPanels.length; i++) { tabPanels[i].classList.toggle('on', tabPanels[i].id === id); }
			/* 패널이 바뀌면 섹션 높이가 달라지므로 위치를 다시 잰다 */
			if (window.jungleRemeasure) { window.jungleRemeasure(0); }
		});
	}

	/* 시즌 그림 크게 보기
	   포스터는 세로로 길어 목록 크기로는 재료 글씨가 안 읽힌다. */
	var msView = document.getElementById('ms_view');
	if (msView) {
		var msImg = msView.querySelector('img');
		var msFrom = null;

		function msOpen(btn) {
			msImg.src = btn.getAttribute('data-src');
			msImg.alt = btn.querySelector('img') ? btn.querySelector('img').alt : '';
			msView.hidden = false;
			document.body.style.overflow = 'hidden';
			msFrom = btn;
			var c = msView.querySelector('.ms_close');
			if (c) { c.focus(); }
		}
		function msClose() {
			msView.hidden = true;
			msImg.src = '';
			document.body.style.overflow = '';
			if (msFrom) { msFrom.focus(); msFrom = null; }
		}

		document.addEventListener('click', function (e) {
			var btn = e.target.closest ? e.target.closest('.ms_btn') : null;
			if (btn) { msOpen(btn); return; }
			/* 그림 바깥(어두운 바탕)이나 닫기 단추를 누르면 닫는다 */
			if (!msView.hidden && (e.target === msView || e.target.closest('.ms_close'))) { msClose(); }
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && !msView.hidden) { msClose(); }
		});
	}

	/* 팝업
	   '오늘 하루 보지 않기' 는 이 브라우저에만 남는다. 서버에 둘 일이 아니고,
	   사람마다 다르게 기억해야 한다. 날짜를 같이 적어 두고 날이 바뀌면
	   저절로 다시 뜬다.
	   닫기는 한 벌이다. 체크하고 닫으면 지금 뜬 알림을 모두 오늘 하루 숨긴다. */
	var jpLayer = document.getElementById('jp_layer');
	if (jpLayer) {
		var jpNow = new Date();
		var jpStamp = jpNow.getFullYear() + '-' + (jpNow.getMonth() + 1) + '-' + jpNow.getDate();
		var jpKey = function (id) { return 'jungle_popup_' + id; };

		/* 오늘 안 보기로 해 둔 것은 아예 지운다 */
		Array.prototype.forEach.call(jpLayer.querySelectorAll('.jp_item'), function (it) {
			var hid = false;
			try { hid = localStorage.getItem(jpKey(it.getAttribute('data-jp'))) === jpStamp; } catch (e) {}
			if (hid) { it.parentNode.removeChild(it); }
		});

		if (!jpLayer.querySelector('.jp_item')) {
			jpLayer.parentNode.removeChild(jpLayer);
		} else {
			document.body.style.overflow = 'hidden';
			/* 위에서 몇 장을 덜어 냈을 수 있다. 슬라이더는 이미 한 번 재 둔
			   상태라 화살표가 남아 있을 수 있어, 바로 다시 재게 한다. */
			var jpSlider = jpLayer.querySelector('.s_slider');
			if (jpSlider && jpSlider.jungleSync) { jpSlider.jungleSync(); }

			var jpClose = function () {
				var chk = jpLayer.querySelector('.jp_today input');
				if (chk && chk.checked) {
					Array.prototype.forEach.call(jpLayer.querySelectorAll('.jp_item'), function (it) {
						try { localStorage.setItem(jpKey(it.getAttribute('data-jp')), jpStamp); } catch (e) {}
					});
				}
				jpLayer.hidden = true;
				document.body.style.overflow = '';
			};

			jpLayer.addEventListener('click', function (e) {
				if (e.target.closest && e.target.closest('.jp_close')) { jpClose(); return; }
				/* 바깥(어두운 바탕)을 눌러도 닫는다. 체크해 둔 것은 그대로 기억한다. */
				if (e.target === jpLayer) { jpClose(); }
			});
			/* 그림을 눌러 넘어가면 돌아왔을 때 또 보일 이유가 없다 */
			Array.prototype.forEach.call(jpLayer.querySelectorAll('a.jp_pic'), function (a) {
				a.addEventListener('click', jpClose);
			});
			document.addEventListener('keydown', function (e) {
				if (e.key === 'Escape' && !jpLayer.hidden) { jpClose(); }
			});
		}
	}

})();
