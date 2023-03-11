(()=>{
    Nova.isCurrentResource = ($resource) => location.href.slice(location.href.indexOf('/resources/') + 11).split('/')[0] === String($resource).trim();

    Nova.addShortcut('ctrl+g', (e)=> {
        try {
            e.preventDefault();

            let classList = window.document.children[0].classList;
            classList.toggle('dark');
            window.localStorage.setItem('novaTheme', classList.contains('dark') ? 'dark' : 'light')
        } catch (e) {

        }
    });
})();
