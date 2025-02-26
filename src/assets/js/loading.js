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

        // gsap.set('#loading', {
        //     backgroundColor: '#000',                
        // })        
        // this.startAnimation();
    }


    hideLoading() {
        $('#loading').remove();
    }

    restartVideo() {
        const $video = gsap.utils.toArray('.js__loading__restartVideo');
        $video.forEach((video) => {
            // 一度停止
            video.pause();
            // 一度最初に戻す                    
            video.currentTime = 0;
            // 再生
            video.play();
        })        
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
                duration: 1.,
                onStart: () => {
                    const _tl = gsap.timeline({
                        delay: 0.7,
                    });
                    _tl
                        .to("#loading__logo", { opacity: 1, duration: 0.075})
                        .to("#loading__logo", { opacity: 0, duration: 0.05 })
                        .to("#loading__logo", { opacity: 1, duration: 0.075 })
                        .to("#loading__logo", { opacity: 0, duration: 0.05 })
                        .to("#loading__logo", { opacity: 1, duration: .15, delay: 0.05 })                       
                }                
            })                
            .to('#loading__main', {
                opacity: 0,
                ease: 'sine.inOut',                       
                duration: .6, 
                delay: .4,              
            })                       
            .to('#loading__main', {
                scale: 20,
                duration: .6,
                delay: -.6,
                ease: 'sine.in',
            })                 
            .to('#loading', {
                background: '#fff',                
                ease: 'sine.out',                                                       
                duration: .4,              
                delay: -0.3 
            })                   
            .to('#loading', {
                background: '#fff',                
                ease: 'sine.out',                                                       
                opacity: 0,
                duration: .4,
                delay: -.3,
                onStart: () => {
                    this.restartVideo(); 
                }
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