export default class CreateCss {
  constructor() {}

  create({ style, media, id }) {
    const elm = document.createElement('style');
    elm.media = media || 'screen';
    elm.appendChild(document.createTextNode(style));
    if (id) {
      elm.id = id;
      this.remove(id);
    }
    return document.getElementsByTagName('head')[0].appendChild(elm);
  }

  remove(id) {
    const target = document.getElementById(id);
    if (target) {
      target.parentNode.removeChild(target);
    }
  }
}
