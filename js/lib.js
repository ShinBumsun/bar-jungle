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

	/* 헤더 고정 상태 + 히어로 패럴랙스 */
	var ticking = false;
	function onScroll() {
		var sy = window.pageYOffset || document.documentElement.scrollTop;
		if (header) { header.classList.toggle('fix', sy > 60); }
		if (!reduce && hero && sy < window.innerHeight * 1.2) {
			if (heFar) { heFar.style.transform = 'translateY(' + (sy * 0.1) + 'px)'; }
			if (heBush) { heBush.style.transform = 'translateY(' + (sy * 0.16) + 'px)'; }
			if (heAnimals) { heAnimals.style.transform = 'translateY(' + (sy * 0.24) + 'px)'; }
			if (heTitle) {
				heTitle.style.transform = 'translateX(-50%) translateY(' + (sy * 0.36) + 'px)';
				heTitle.style.opacity = Math.max(0, 1 - sy / (window.innerHeight * 0.62));
			}
		}
		updateJungle(sy);
		ticking = false;
	}

	/* 정글 헤쳐나가기 : 섹션 진입 진행도(0~1)에 맞춰 풀숲이 갈라짐 */
	function updateJungle(sy) {
		var vh = window.innerHeight;
		var i, p;
		for (i = 0; i < veils.length; i++) {
			p = 1 - (veils[i].getBoundingClientRect().top / vh);
			veils[i].style.setProperty('--p', (p < 0 ? 0 : p > 1 ? 1 : p).toFixed(3));
		}
		/* 아래로 갈수록 짙어지는 숲 그늘 */
		var max = document.documentElement.scrollHeight - vh;
		if (wrap) { wrap.style.setProperty('--depth', max > 0 ? (sy / max).toFixed(3) : 0); }
		/* 지금 몇 번째 층인지 */
		var active = -1, tone = 'dark';
		for (i = 0; i < tones.length; i++) {
			var r = tones[i].getBoundingClientRect();
			if (r.top <= vh * 0.5 && r.bottom > vh * 0.5) { active = i; tone = tones[i].getAttribute('data-tone'); }
		}
		if (depthNav) { depthNav.classList.toggle('light', tone === 'light'); }
		for (i = 0; i < depthItems.length; i++) {
			depthItems[i].classList.toggle('on', i === active);
		}
	}
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

})();
