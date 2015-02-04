function Slider( container, nav ) {
  this.container = container;
  this.nav = nav.show();

  this.imgs = this.container.find("img");
  this.imgWidth = this.imgs[0].width;
  this.imgsLen = this.imgs.length;

  this.current = 0;
}

Slider.prototype.transition = function( coords ) {
  this.container.animate({
    marginLeft: coords || -(this.current * this.imgWidth)
  });
};

Slider.prototype.setCurrent = function( dir ) {
  var pos = this.current;

  pos += (~~(dir === "next") || -1);
  this.current = (pos < 0) ? (this.imgsLen - 1) : pos % this.imgsLen;

  return pos;
}
