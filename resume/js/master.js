document.addEventListener('DOMContentLoaded', setup);


function setup(){
    
    const observer = new IntersectionObserver((entries,observer) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('show')
                observer.unobserve
            }else{
                return
               
            }
        })
    })
    const selected = document.querySelectorAll('.trans')
    selected.forEach(select => {
        observer.observe(select)
    })
}