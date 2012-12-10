function AnimatedDiv(id,frames,wait,dir) {
  this.element = typeof id=="string" ? document.getElementById(id) : id;
  this.frames=frames;
  this.index=0;
  this.dir=dir||'round-robin';
  this.wait=wait;
  this.intervalId=null;
}
AnimatedDiv.prototype={
  start: function(afterAnimate) {
    var self=this;
    function animate() {
      self.animate.call(self);
    }
    this.afterAnimate = afterAnimate;
    this.n = 0;
    this.intervalId = setInterval(animate, this.wait);
  },
  stop: function() {
    if (this.intervalId) {
      clearInterval(this.intervalId);
      this.intervalId=null;
    }
  },
  animate: function() {
    this.element.innerHTML=this.frames[this.index];
    this.advanceFrame();
    if (this.afterAnimate) this.afterAnimate(this.n++);
  },
  advanceFrame: function() {
    switch(this.dir) {
    case 'round-robin':
      if(++this.index>=this.frames.length) this.index=0;
      break;
    case 'right':
      if(++this.index>=this.frames.length) {
        this.index-=2;
        this.dir='left';
      }
      break;
    case 'left':
      if(--this.index<0) {
        this.index+=2;
        this.dir='right';
      }
      break;
    default:
      throw new Error('Unknown direction ('+this.element.id+' '+this.dir+')');
    }
  }
};
function getLupper(element) {
  var pos = [0,0];
  do {
    pos[0] += element.offsetLeft;
    pos[1] += element.offsetTop;
  } while (element = element.offsetParent);
  return pos;
}
