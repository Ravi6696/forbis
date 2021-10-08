// foorbis-sidebar-menu-bar

$('.responive-left-menu').click(function() {
    $(".foorbis-sidebar").addClass("foorbis-sidebar-open");
});

$('.foorbis-sidebar-close').click(function() {
    $(".foorbis-sidebar").removeClass("foorbis-sidebar-open");
});



// notifications-bar-right 
$('.notification-popup').click(function() {
    $("#notifications-bar-right").addClass("drawer-bar-open");
});

$('.drawer-close').click(function() {
    $("#notifications-bar-right").removeClass("drawer-bar-open");
});

// message-bar-right 
$('.message-popup').click(function() {
    $("#message-bar-right").addClass("drawer-bar-open");
});

$('.drawer-close').click(function() {
    $("#message-bar-right").removeClass("drawer-bar-open");
});


// dashboard-pro switch one
let dashboardButton1 = document.getElementById('dashboardButton1');
let dashboardButton2 = document.getElementById('dashboardButton2');

dashboardButton1.addEventListener("click", () => {
    if (dashboardButton1.classList.contains('notactive')) {
        dashboardButton1.classList.remove('notactive');
        dashboardButton1.classList.add('active');
        dashboardButton2.classList.remove('active');
        dashboardButton2.classList.add('notactive');
    }
})
dashboardButton2.addEventListener("click", () => {
    if (dashboardButton2.classList.contains('notactive')) {
        dashboardButton2.classList.remove('notactive');
        dashboardButton2.classList.add('active');
        dashboardButton1.classList.remove('active');
        dashboardButton1.classList.add('notactive');
    }
})

// dashboard-pro switch two
let announces = document.getElementById('announces');
let mes = document.getElementById('mes');

if (announces != null) {
    announces.addEventListener("click", () => {
        if (announces.classList.contains('notactive')) {
            announces.classList.remove('notactive');
            announces.classList.add('active');
            mes.classList.remove('active');
            mes.classList.add('notactive');
        }
    })
}
if (mes != null) {
    mes.addEventListener("click", () => {
        if (mes.classList.contains('notactive')) {
            mes.classList.remove('notactive');
            mes.classList.add('active');
            announces.classList.remove('active');
            announces.classList.add('notactive');
        }
    })
}


// dashboard-pro switch three
let switchButton1 = document.getElementById('switchButton1');
let switchButton2 = document.getElementById('switchButton2');

if (switchButton1 != null) {
    switchButton1.addEventListener("click", () => {
        if (switchButton1.classList.contains('notactive')) {
            switchButton1.classList.remove('notactive');
            switchButton1.classList.add('active');
            switchButton2.classList.remove('active');
            switchButton2.classList.add('notactive');
        }
    })
}
if (switchButton2 != null) {
    switchButton2.addEventListener("click", () => {
        if (switchButton2.classList.contains('notactive')) {
            switchButton2.classList.remove('notactive');
            switchButton2.classList.add('active');
            switchButton1.classList.remove('active');
            switchButton1.classList.add('notactive');
        }
    })
}


let HoraireButton1 = document.getElementById('HoraireButton1');
let HoraireButton2 = document.getElementById('HoraireButton2');

if (switchButton2 != null) {
    HoraireButton1.addEventListener("click", () => {
        if (HoraireButton1.classList.contains('notactive')) {
            HoraireButton1.classList.remove('notactive');
            HoraireButton1.classList.add('active');
            HoraireButton2.classList.remove('active');
            HoraireButton2.classList.add('notactive');
        }
    })
}
if (switchButton2 != null) {
    HoraireButton2.addEventListener("click", () => {
        if (HoraireButton2.classList.contains('notactive')) {
            HoraireButton2.classList.remove('notactive');
            HoraireButton2.classList.add('active');
            HoraireButton1.classList.remove('active');
            HoraireButton1.classList.add('notactive');
        }
    })
}


let AgendaButton1 = document.getElementById('AgendaButton1');
let AgendaButton2 = document.getElementById('AgendaButton2');

if (AgendaButton1 != null) {
    AgendaButton1.addEventListener("click", () => {
        if (AgendaButton1.classList.contains('notactive')) {
            AgendaButton1.classList.remove('notactive');
            AgendaButton1.classList.add('active');
            AgendaButton2.classList.remove('active');
            AgendaButton2.classList.add('notactive');
        }
    })
}
if (AgendaButton2 != null) {
    AgendaButton2.addEventListener("click", () => {
        if (AgendaButton2.classList.contains('notactive')) {
            AgendaButton2.classList.remove('notactive');
            AgendaButton2.classList.add('active');
            AgendaButton1.classList.remove('active');
            AgendaButton1.classList.add('notactive');
        }
    })
}

let commentaires1 = document.getElementById('commentaires1');
let commentaires2 = document.getElementById('commentaires2');

if (commentaires1 != null) {
    commentaires1.addEventListener("click", () => {
        if (commentaires1.classList.contains('notactive')) {
            commentaires1.classList.remove('notactive');
            commentaires1.classList.add('active');
            commentaires2.classList.remove('active');
            commentaires2.classList.add('notactive');
        }
    })
}
if (commentaires2 != null) {
    commentaires2.addEventListener("click", () => {
        if (commentaires2.classList.contains('notactive')) {
            commentaires2.classList.remove('notactive');
            commentaires2.classList.add('active');
            commentaires1.classList.remove('active');
            commentaires1.classList.add('notactive');
        }
    })
}