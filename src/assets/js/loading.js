import gsap from 'gsap';
import $ from 'jquery';

class Loading {
    constructor() {    
        const isAlreadyLoading = this.chackHasSettionStrage();        
        if(isAlreadyLoading) {
            this.hideLoading();
        } else {
            this.setSessionStorage();            
            setTimeout(() => {
                this.startAnimation();
            },500)            
        }                
    }


    hideLoading() {
        $('#loading').remove();
    }

    startAnimation() {
        const tl = gsap.timeline({            
            onComplete: () => {
                $('#loading').remove();
            }
        });
        tl
            .to('#loading', {
                backgroundColor: '#000',
                duration: .2,
            })
            .to('#loading__text', {
                maskPosition: '-150% 0',
                duration: 1.5,
                delay: 0.3,
                ease: 'sine.out'
            })
            .to("#loading__logo", { opacity: 1, duration: 0.1, })
            .to("#loading__logo", { opacity: 0, duration: 0.05 })
            .to("#loading__logo", { opacity: 1, duration: 0.1 })
            .to("#loading__logo", { opacity: 0, duration: 0.05 })
            .to("#loading__logo", { opacity: 1, duration: 0.1 })
            .to("#loading__logo", { opacity: 0, duration: 0.05 })
            .to("#loading__logo", { opacity: 1, duration: .3, delay: 0.1 })                   
            .to('#loading__main', {
                opacity: 0,
                ease: 'sine.out',                       
                duration: .8,       
                delay: 1,                         
            })                       
            .to('#loading__main', {
                scale: 3,
                duration: .8,
                delay: -.8,
                ease: 'sine.out',
            })                 
            .to('#loading', {
                background: '#fff',                
                ease: 'sine.out',                                                       
                duration: .5,                  
                delay: -0.25            
            })                   
            .to('#loading', {
                background: '#fff',                
                ease: 'sine.out',                                                       
                opacity: 0,
                delay: -.25
            })                   

    } 

    chackHasSettionStrage() {
        return window.sessionStorage.getItem('loading') === 'true';
    }

    setSessionStorage() {
        window.sessionStorage.setItem('loading', 'true');
    }
}

export default Loading;