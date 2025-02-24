import gsap from 'gsap';
import $ from 'jquery';

class Loading {
    constructor() {    
        if(this.chackHasSettionStrage()) {
            this.hideLoading();
        } else {
            this.setSessionStorage();            
            this.startAnimation()
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
                duration: 1.,
            })
            .to("#loading__logo", { opacity: 1, duration: 0.1 })
            .to("#loading__logo", { opacity: 0, duration: 0.05 })
            .to("#loading__logo", { opacity: 1, duration: 0.1 })
            .to("#loading__logo", { opacity: 0, duration: 0.05 })
            .to("#loading__logo", { opacity: 1, duration: 0.1 })
            .to("#loading__logo", { opacity: 0, duration: 0.05 })
            .to("#loading__logo", { opacity: 1, duration: .3, delay: 0.1 })       
            .to('#loading', {
                background: '#fff',
                ease: 'sine.out',                       
                duration: .5,
                delay: .5,
            })                  
            .to('#loading__main', {
                scale: 25,                                
                duration: 1.,
                delay: -1,
                ease: 'sine.in',
            })            
            .to('#loading__main', {
                opacity: 0,
                ease: 'sine.out',                       
                duration: 1.,
                delay: -1.
            })         
            .to('#loading', {
                background: '#fff',
                ease: 'sine.out',                       
                opacity: 0,
                delay: -.5,
                duration: .5,                              
            })                   

    } 

    chackHasSettionStrage() {
        return sessionStorage.getItem('loading') === 'true';
    }

    setSessionStorage() {
        sessionStorage.setItem('loading', 'true');
    }
}

export default Loading;