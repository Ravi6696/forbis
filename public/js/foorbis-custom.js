let announces = document.getElementById('announces');
let mes = document.getElementById('mes');

announces.addEventListener("click", () => {
    if (announces.classList.contains('notactive')) {
        announces.classList.remove('notactive');
        announces.classList.add('active');
        mes.classList.remove('active');
        mes.classList.add('notactive');
    }
})
mes.addEventListener("click", () => {
    if (mes.classList.contains('notactive')) {
        mes.classList.remove('notactive');
        mes.classList.add('active');
        announces.classList.remove('active');
        announces.classList.add('notactive');
    }
})

let createBtn1 = document.getElementById('createBtn1');
let createBtn2 = document.getElementById('createBtn2');
let closePopup = document.getElementById('closePopup');
let foorbisPenal = document.getElementById('foorbis-penal');
let createPopup = document.getElementById('createPopup');
let popupCard = document.getElementById('popupCard');

const popUp = () => {
    foorbisPenal.style.overflow = "hidden";
    createPopup.style.display = "flex";
    setTimeout(() => {
        popupCard.style.transform = "translateY(0%)";
    }, 100);
}

const closeFun = () => {
    foorbisPenal.style.overflow = "auto";
    popupCard.style.transform = "translateY(-200%)";
    setTimeout(() => {
        createPopup.style.display = "none";
    }, 500);
}

createBtn1.addEventListener("click", popUp);
createBtn2.addEventListener("click", popUp);

closePopup.addEventListener('click', closeFun)

// foorbis-sidebar-menu-bar

$('.responive-left-menu').click(function() {
    $(".foorbis-sidebar").addClass("foorbis-sidebar-open");
});

$('.foorbis-sidebar-close').click(function() {
    $(".foorbis-sidebar").removeClass("foorbis-sidebar-open");
});