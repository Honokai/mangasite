window.addEventListener('load', function(){
    //select_manga = document.getElementById('manga')
    //$('#manga').select2();
    let tema = true //para tema claro = true
    
    document.getElementById('TemaSeletor').addEventListener('click', function(elemento){
        let url = 'http://localhost:8000/'
        if(tema == true){
            
            this.src = 'https://www.iconsdb.com/icons/preview/white/moon-4-xxl.png'
            
            console.log(this.src)
            let cartoes = document.querySelectorAll('div.card')
            let navbar = document.querySelector('nav.navbar.navbar-expand-lg.navbar-light.bg-light')
            navbar.classList.remove('navbar-light')
            navbar.classList.remove('bg-light')
            navbar.classList.add('dark-accent')
            cartoes.forEach(elemento => {
                elemento.classList.add('dark-accent')
                //console.log()
            })
            tema = false
        } else {
            this.src = 'https://image.flaticon.com/icons/svg/702/702471.svg'
            
            console.log(this.src)
            let cartoes = document.querySelectorAll('div.card')
            let navbar = document.querySelector('nav.navbar.navbar-expand-lg.dark-accent')
            navbar.classList.remove('dark-accent')
            navbar.classList.add('navbar-light')
            navbar.classList.add('bg-light')
            cartoes.forEach(elemento => {
                elemento.classList.remove('dark-accent')
                //console.log()
            })

            tema = true
        }
        
    })
})

