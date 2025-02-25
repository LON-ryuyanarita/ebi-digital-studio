import $ from 'jquery';

export default class OnlineConnection {
  constructor(params = {}) {}

  init() {
    this.$trigger = $('[data-ebi-onlineconnection]');

    this.$trigger.on('click.ebi.oc', (e) => {
      e.preventDefault();
      const inputed = prompt(
        'ONLINE CONNECTIONについて\n※こちらはPORSCHE PRO案内のもと、ご利用ください。\nパスワードをご入力の上、ご入室ください。'
      );
      if (!!inputed) {
        open(
          `https://zoom.us/j/92840087470?pwd=NVNZU1JGS0ZGclpNUHhqUzduQVlIQ${inputed}`,
          '_blank'
        );
      }

      // if (/\W+/g.test(inputed)) {
      //   alert('半角英数字のみを入力して下さい。');
      // } else if (inputed == '') {
      //   alert('正しいパスワードを入力ください。');
      // } else if (inputed != null) {
      //   open(
      //     `https://zoom.us/j/92840087470?pwd=NVNZU1JGS0ZGclpNUHhqUzduQVlIQ${inputed}`,
      //     '_blank'
      //   );
      // }
    });
  }
}
