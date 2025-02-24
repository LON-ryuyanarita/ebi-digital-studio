import gsap from 'gsap';
import $ from 'jquery';

class Loading {
    constructor() {    
        const isAlreadyLoading = this.chackHasSettionLocalStorage();        
        if(isAlreadyLoading) {
            this.hideLoading();
        } else {
            gsap.set('#loading', {
                backgroundColor: '#000',                
            })
            setTimeout(() => {
                this.startAnimation();
            },500)            
        }               
        this.setLocalStorage(); 
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
    
    chackHasSettionLocalStorage() {
        const storedTime = window.localStorage.getItem('loading');        
        if (!storedTime) {
          // 保存された日時がない場合は、設定可能（trueを返す）
            return false;
        }
        const storedDate = new Date(storedTime);
        const now = new Date();
        const diff = now - storedDate; // ミリ秒単位
        // 24時間以内なら false を返し、24時間経過していれば true を返す
        return diff < 1000 * 60 * 60 * 24;
    }
    
    setLocalStorage() {
        // 現在の日時を ISO 形式の文字列で保存
        window.localStorage.setItem('loading', new Date().toISOString());
    }
}

export default Loading;