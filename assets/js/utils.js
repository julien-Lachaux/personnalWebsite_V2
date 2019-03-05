Array.prototype.shuffle = function(n)
{
     if(!n)
          n = this.length;
     if(n > 1)
     {
          var i = randomInt(0, n-1);
          var tmp = this[i];
          this[i] = this[n-1];
          this[n-1] = tmp;
          this.shuffle(n-1);
     }
}

export function randomInt(mini, maxi)
{
     var nb = mini + (maxi+1-mini)*Math.random();
     return Math.floor(nb);
}
  
export function copy(text) {
    window.clipboardData.setData("Text", text);
}