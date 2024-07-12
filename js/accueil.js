var translations = {
    'fr': {
        'profiles': 'PROFILS SPORTIFS',
        'blog': 'BLOG',
        'calendar': 'CALENDRIER',
        'community': 'COMMUNAUTÉ',
        'partnerships': 'PARTENARIATS',
        'heroTitle': 'QUAND LES SPORTIFS MARTINIQUAIS INSPIRENT L\'EXCELLENCE',
        'heroAuthor': 'Gérard Janvion',
        'heroBio': 'L\'inoubliable - Fair play'
    },
    'en': {
        'profiles': 'SPORTS PROFILES',
        'blog': 'BLOG',
        'calendar': 'CALENDAR',
        'community': 'COMMUNITY',
        'partnerships': 'PARTNERSHIPS',
        'heroTitle': 'WHEN MARTINICAN ATHLETES INSPIRE EXCELLENCE',
        'heroAuthor': 'Gérard Janvion',
        'heroBio': 'The unforgettable - Fair play'
    },
    'es': {
        'profiles': 'PERFILES DEPORTIVOS',
        'blog': 'BLOG',
        'calendar': 'CALENDARIO',
        'community': 'COMUNIDAD',
        'partnerships': 'SOCIOS',
        'heroTitle': 'CUANDO LOS DEPORTISTAS MARTINIQUENSES INSPIRAN LA EXCELENCIA',
        'heroAuthor': 'Gérard Janvion',
        'heroBio': 'El inolvidable - Fair play'
    }
};

function changeLanguage() {
    var language = document.getElementById('language-select').value;
    var translate = translations[language];

    var profilSelect = document.getElementById('profil-select');
    if (profilSelect) {
        profilSelect.options[0].innerText = translate['profiles'];
    }

    document.getElementById('blog-link').innerText = translate['blog'];
    document.getElementById('calendar-link').innerText = translate['calendar'];
    document.getElementById('community-link').innerText = translate['community'];
    document.getElementById('partnerships-link').innerText = translate['partnerships'];

    document.getElementById('hero-title').innerText = translate['heroTitle'];
    document.getElementById('hero-author').innerText = translate['heroAuthor'];
    document.getElementById('hero-bio').innerText = translate['heroBio'];
}

// Initial call to set default language
changeLanguage();

function goToProfile() {
    var selectBox = document.getElementById("profil-select");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    if (selectedValue) {
        window.location = selectedValue;
    }
}