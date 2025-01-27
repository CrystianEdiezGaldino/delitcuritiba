$(document).ready(function () {
	$('.toTop').click(function () {
		$('body,html').animate({ scrollTop: 0 }, 500)
	})

	function updateClock() {
		const now = new Date()
		const hours = String(now.getHours()).padStart(2, '0')
		const minutes = String(now.getMinutes()).padStart(2, '0')
		const seconds = String(now.getSeconds()).padStart(2, '0')
		$('#clock').text(`${hours}:${minutes}:${seconds}`)
	}

	// Обновляем каждую секунду
	setInterval(updateClock, 1000)

	// Первоначальный вызов, чтобы сразу отобразить время
	updateClock()

	// dropdown-custom
	$('.dropdown-custom-toggle').click(function (event) {
		$('.dropdown-custom-menu').not($(this).next()).slideUp(400)
		$('.dropdown-custom-toggle').not($(this)).removeClass('active')
		$(this).toggleClass('active')
		$(this).parent('.dropdown-custom').toggleClass('active')
		$(this).next('.dropdown-custom-menu').slideToggle(400)
		event.stopPropagation()
	})

	$(document).click(function (event) {
		if ($(event.target).parents('.dropdown-custom').length === 0) {
			$('.dropdown-custom-menu').slideUp(400)
			$('.dropdown-custom-toggle').removeClass('active')
			$('.dropdown-custom').removeClass('active')
		}
	})

	const countdownDuration = 60 * 60
	let timerInterval

	function updateTimer() {
		const now = new Date().getTime()
		const endTime = localStorage.getItem('endTime')

		if (endTime) {
			const timeLeft = Math.floor((endTime - now) / 1000)

			if (timeLeft <= 0) {
				clearInterval(timerInterval)
				$('.time').text('00:00:00')

				startTimer()
				return
			}

			const hours = Math.floor(timeLeft / 3600)
			const minutes = Math.floor((timeLeft % 3600) / 60)
			const seconds = timeLeft % 60

			const timeFormatted =
				(hours < 10 ? '0' + hours : hours) +
				':' +
				(minutes < 10 ? '0' + minutes : minutes) +
				':' +
				(seconds < 10 ? '0' + seconds : seconds)

			$('.time').text(timeFormatted)
		}
	}

	function startTimer() {
		const now = new Date().getTime()
		const endTime = now + countdownDuration * 1000

		localStorage.setItem('endTime', endTime)

		timerInterval = setInterval(updateTimer, 1000)
	}

	if (localStorage.getItem('endTime')) {
		updateTimer()
		timerInterval = setInterval(updateTimer, 1000)
	} else {
		startTimer()
	}

	//tabs

	$('.tabs div').click(function () {
		$('.tabs div').removeClass('tab-link--active')
		$('.tab-content').removeClass('active')

		const tabId = $(this).data('tab')
		$(this).addClass('tab-link--active')
		$('#' + tabId).addClass('active')
	})

	// hamburger menu
	$('.hamburger-menu').click(function () {
		$('.hamburger-menu-content').addClass('active')
	})

	$('.hamburger-menu-close').click(function () {
		$('.hamburger-menu-content').removeClass('active')
	})

	$('.openModal').click(function () {
		const modalId = '#' + $(this).data('id')
		$(modalId).fadeIn()
	})

	$('.close').click(function () {
		$(this).parents('.modal').fadeOut()
	})
})
