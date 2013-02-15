if (!String.prototype.trim) {
   //code for trim
   String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};

   String.prototype.ltrim=function(){return this.replace(/^\s+/,'');};

   String.prototype.rtrim=function(){return this.replace(/\s+$/,'');};

   String.prototype.fulltrim=function(){return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,'').replace(/\s+/g,' ');};
}