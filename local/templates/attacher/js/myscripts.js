$().fancybox({
    selector: '[data-fancybox="images"]',
    thumbs: {
        // Показывать превью
        autoStart: false,
    },
    keyboard: true,
    buttons: [
        // Показывать кнопку закрытия модалки
        "close"
    ],
    // Эффект анимации при перелючении
    transitionEffect: "zoom-in-out",
    // Зацикливать превью
    loop: true,
});