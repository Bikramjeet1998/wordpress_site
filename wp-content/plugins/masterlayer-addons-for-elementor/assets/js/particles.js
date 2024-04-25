var pJS=function(e,i){var a=document.querySelector("#"+e+" > .particles-js-canvas-el");this.pJS={canvas:{el:a,w:a.offsetWidth,h:a.offsetHeight},particles:{number:{value:400,density:{enable:!0,value_area:800}},color:{value:"#fff"},shape:{type:"circle",stroke:{width:0,color:"#ff0000"},polygon:{nb_sides:5},image:{src:"",width:100,height:100,replace_color:!0}},opacity:{value:1,random:!1,anim:{enable:!1,speed:2,opacity_min:0,sync:!1}},size:{value:20,random:!1,anim:{enable:!1,speed:20,size_min:0,sync:!1}},line_linked:{enable:!0,distance:100,color:"#fff",opacity:1,width:1},move:{enable:!0,speed:2,direction:"none",random:!1,straight:!1,out_mode:"out",bounce:!1,attract:{enable:!1,rotateX:3e3,rotateY:3e3}},array:[]},interactivity:{detect_on:"canvas",events:{onhover:{enable:!0,mode:"grab"},onclick:{enable:!0,mode:"push"},resize:!0},modes:{grab:{distance:100,line_linked:{opacity:1}},bubble:{distance:200,size:80,duration:.4},repulse:{distance:200,duration:.4},push:{particles_nb:4},remove:{particles_nb:2}},mouse:{}},retina_detect:!1,fn:{interact:{},modes:{},vendors:{}},tmp:{}};var t=this.pJS;i&&Object.deepExtend(t,i),t.tmp.obj={size_value:t.particles.size.value,size_anim_speed:t.particles.size.anim.speed,move_speed:t.particles.move.speed,line_linked_distance:t.particles.line_linked.distance,line_linked_width:t.particles.line_linked.width,mode_grab_distance:t.interactivity.modes.grab.distance,mode_bubble_distance:t.interactivity.modes.bubble.distance,mode_bubble_size:t.interactivity.modes.bubble.size,mode_repulse_distance:t.interactivity.modes.repulse.distance},t.fn.retinaInit=function(){t.retina_detect&&window.devicePixelRatio>1?(t.canvas.pxratio=window.devicePixelRatio,t.tmp.retina=!0):(t.canvas.pxratio=1,t.tmp.retina=!1),t.canvas.w=t.canvas.el.offsetWidth*t.canvas.pxratio,t.canvas.h=t.canvas.el.offsetHeight*t.canvas.pxratio,t.particles.size.value=t.tmp.obj.size_value*t.canvas.pxratio,t.particles.size.anim.speed=t.tmp.obj.size_anim_speed*t.canvas.pxratio,t.particles.move.speed=t.tmp.obj.move_speed*t.canvas.pxratio,t.particles.line_linked.distance=t.tmp.obj.line_linked_distance*t.canvas.pxratio,t.interactivity.modes.grab.distance=t.tmp.obj.mode_grab_distance*t.canvas.pxratio,t.interactivity.modes.bubble.distance=t.tmp.obj.mode_bubble_distance*t.canvas.pxratio,t.particles.line_linked.width=t.tmp.obj.line_linked_width*t.canvas.pxratio,t.interactivity.modes.bubble.size=t.tmp.obj.mode_bubble_size*t.canvas.pxratio,t.interactivity.modes.repulse.distance=t.tmp.obj.mode_repulse_distance*t.canvas.pxratio},t.fn.canvasInit=function(){t.canvas.ctx=t.canvas.el.getContext("2d")},t.fn.canvasSize=function(){t.canvas.el.width=t.canvas.w,t.canvas.el.height=t.canvas.h,t&&t.interactivity.events.resize&&window.addEventListener("resize",function(){t.canvas.w=t.canvas.el.offsetWidth,t.canvas.h=t.canvas.el.offsetHeight,t.tmp.retina&&(t.canvas.w*=t.canvas.pxratio,t.canvas.h*=t.canvas.pxratio),t.canvas.el.width=t.canvas.w,t.canvas.el.height=t.canvas.h,t.particles.move.enable||(t.fn.particlesEmpty(),t.fn.particlesCreate(),t.fn.particlesDraw(),t.fn.vendors.densityAutoParticles()),t.fn.vendors.densityAutoParticles()})},t.fn.canvasPaint=function(){t.canvas.ctx.fillRect(0,0,t.canvas.w,t.canvas.h)},t.fn.canvasClear=function(){t.canvas.ctx.clearRect(0,0,t.canvas.w,t.canvas.h)},t.fn.particle=function(e,i,a){if(this.radius=(t.particles.size.random?Math.random():1)*t.particles.size.value,t.particles.size.anim.enable&&(this.size_status=!1,this.vs=t.particles.size.anim.speed/100,t.particles.size.anim.sync||(this.vs=this.vs*Math.random())),this.x=a?a.x:Math.random()*t.canvas.w,this.y=a?a.y:Math.random()*t.canvas.h,this.x>t.canvas.w-2*this.radius?this.x=this.x-this.radius:this.x<2*this.radius&&(this.x=this.x+this.radius),this.y>t.canvas.h-2*this.radius?this.y=this.y-this.radius:this.y<2*this.radius&&(this.y=this.y+this.radius),t.particles.move.bounce&&t.fn.vendors.checkOverlap(this,a),this.color={},"object"==typeof e.value){if(e.value instanceof Array){var s=e.value[Math.floor(Math.random()*t.particles.color.value.length)];this.color.rgb=hexToRgb(s)}else void 0!=e.value.r&&void 0!=e.value.g&&void 0!=e.value.b&&(this.color.rgb={r:e.value.r,g:e.value.g,b:e.value.b}),void 0!=e.value.h&&void 0!=e.value.s&&void 0!=e.value.l&&(this.color.hsl={h:e.value.h,s:e.value.s,l:e.value.l})}else"random"==e.value?this.color.rgb={r:Math.floor(256*Math.random())+0,g:Math.floor(256*Math.random())+0,b:Math.floor(256*Math.random())+0}:"string"==typeof e.value&&(this.color=e,this.color.rgb=hexToRgb(this.color.value));this.opacity=(t.particles.opacity.random?Math.random():1)*t.particles.opacity.value,t.particles.opacity.anim.enable&&(this.opacity_status=!1,this.vo=t.particles.opacity.anim.speed/100,t.particles.opacity.anim.sync||(this.vo=this.vo*Math.random()));var r={};switch(t.particles.move.direction){case"top":r={x:0,y:-1};break;case"top-right":r={x:.5,y:-.5};break;case"right":r={x:1,y:-0};break;case"bottom-right":r={x:.5,y:.5};break;case"bottom":r={x:0,y:1};break;case"bottom-left":r={x:-.5,y:1};break;case"left":r={x:-1,y:0};break;case"top-left":r={x:-.5,y:-.5};break;default:r={x:0,y:0}}t.particles.move.straight?(this.vx=r.x,this.vy=r.y,t.particles.move.random&&(this.vx=this.vx*Math.random(),this.vy=this.vy*Math.random())):(this.vx=r.x+Math.random()-.5,this.vy=r.y+Math.random()-.5),this.vx_i=this.vx,this.vy_i=this.vy;var n=t.particles.shape.type;if("object"==typeof n){if(n instanceof Array){var c=n[Math.floor(Math.random()*n.length)];this.shape=c}}else this.shape=n;if("image"==this.shape){var o=t.particles.shape;this.img={src:o.image.src,ratio:o.image.width/o.image.height,replace_color:o.image.replace_color},this.img.ratio||(this.img.ratio=1),"svg"==t.tmp.img_type&&void 0!=t.tmp.source_svg&&(t.fn.vendors.createSvgImg(this),t.tmp.pushing&&(this.img.loaded=!1))}},t.fn.particle.prototype.draw=function(){if(void 0!=this.radius_bubble)var e=this.radius_bubble;else var e=this.radius;if(void 0!=this.opacity_bubble)var i=this.opacity_bubble;else var i=this.opacity;if(this.color.rgb)var a="rgb("+this.color.rgb.r+","+this.color.rgb.g+","+this.color.rgb.b+")";else var a="hsl("+this.color.hsl.h+","+this.color.hsl.s+"%,"+this.color.hsl.l+"%)";switch(t.canvas.ctx.fillStyle=a,t.canvas.ctx.beginPath(),this.shape){case"circle":t.canvas.ctx.arc(this.x,this.y,e,0,2*Math.PI,!1);break;case"edge":t.canvas.ctx.rect(this.x-e,this.y-e,2*e,2*e);break;case"triangle":t.fn.vendors.drawShape(t.canvas.ctx,this.x-e,this.y+e/1.66,2*e,3,2);break;case"polygon":t.fn.vendors.drawShape(t.canvas.ctx,this.x-e/(t.particles.shape.polygon.nb_sides/3.5),this.y-e/.76,2.66*e/(t.particles.shape.polygon.nb_sides/3),t.particles.shape.polygon.nb_sides,1);break;case"star":t.fn.vendors.drawShape(t.canvas.ctx,this.x-2*e/(t.particles.shape.polygon.nb_sides/4),this.y-e/1.52,5.32*e/(t.particles.shape.polygon.nb_sides/3),t.particles.shape.polygon.nb_sides,2);break;case"image":if("svg"==t.tmp.img_type)var s=this.img.obj;else var s=t.tmp.img_obj;s&&(t.canvas.ctx.globalAlpha=i,t.canvas.ctx.drawImage(s,this.x-e,this.y-e,2*e,2*e/this.img.ratio),t.canvas.ctx.globalAlpha=1)}t.canvas.ctx.closePath(),t.particles.shape.stroke.width>0&&(t.canvas.ctx.strokeStyle=t.particles.shape.stroke.color,t.canvas.ctx.lineWidth=t.particles.shape.stroke.width,t.canvas.ctx.stroke()),t.canvas.ctx.fill()},t.fn.particlesCreate=function(){for(var e=0;e<t.particles.number.value;e++)t.particles.array.push(new t.fn.particle(t.particles.color,t.particles.opacity.value))},t.fn.particlesUpdate=function(){for(var e=0;e<t.particles.array.length;e++){var i=t.particles.array[e];if(t.particles.move.enable){var a=t.particles.move.speed/2;i.x+=i.vx*a,i.y+=i.vy*a}if(t.particles.opacity.anim.enable&&(!0==i.opacity_status?(i.opacity>=t.particles.opacity.value&&(i.opacity_status=!1),i.opacity+=i.vo):(i.opacity<=t.particles.opacity.anim.opacity_min&&(i.opacity_status=!0),i.opacity-=i.vo),i.opacity<0&&(i.opacity=0)),t.particles.size.anim.enable&&(!0==i.size_status?(i.radius>=t.particles.size.value&&(i.size_status=!1),i.radius+=i.vs):(i.radius<=t.particles.size.anim.size_min&&(i.size_status=!0),i.radius-=i.vs),i.radius<0&&(i.radius=0)),"bounce"==t.particles.move.out_mode)var s={x_left:i.radius,x_right:t.canvas.w,y_top:i.radius,y_bottom:t.canvas.h};else var s={x_left:-i.radius,x_right:t.canvas.w+i.radius,y_top:-i.radius,y_bottom:t.canvas.h+i.radius};if(i.x-i.radius>t.canvas.w?(i.x=s.x_left,i.y=Math.random()*t.canvas.h):i.x+i.radius<0&&(i.x=s.x_right,i.y=Math.random()*t.canvas.h),i.y-i.radius>t.canvas.h?(i.y=s.y_top,i.x=Math.random()*t.canvas.w):i.y+i.radius<0&&(i.y=s.y_bottom,i.x=Math.random()*t.canvas.w),"bounce"===t.particles.move.out_mode&&(i.x+i.radius>t.canvas.w?i.vx=-i.vx:i.x-i.radius<0&&(i.vx=-i.vx),i.y+i.radius>t.canvas.h?i.vy=-i.vy:i.y-i.radius<0&&(i.vy=-i.vy)),isInArray("grab",t.interactivity.events.onhover.mode)&&t.fn.modes.grabParticle(i),(isInArray("bubble",t.interactivity.events.onhover.mode)||isInArray("bubble",t.interactivity.events.onclick.mode))&&t.fn.modes.bubbleParticle(i),(isInArray("repulse",t.interactivity.events.onhover.mode)||isInArray("repulse",t.interactivity.events.onclick.mode))&&t.fn.modes.repulseParticle(i),t.particles.line_linked.enable||t.particles.move.attract.enable)for(var r=e+1;r<t.particles.array.length;r++){var n=t.particles.array[r];t.particles.line_linked.enable&&t.fn.interact.linkParticles(i,n),t.particles.move.attract.enable&&t.fn.interact.attractParticles(i,n),t.particles.move.bounce&&t.fn.interact.bounceParticles(i,n)}}},t.fn.particlesDraw=function(){t.canvas.ctx.clearRect(0,0,t.canvas.w,t.canvas.h),t.fn.particlesUpdate();for(var e=0;e<t.particles.array.length;e++)t.particles.array[e].draw()},t.fn.particlesEmpty=function(){t.particles.array=[]},t.fn.particlesRefresh=function(){cancelRequestAnimFrame(t.fn.checkAnimFrame),cancelRequestAnimFrame(t.fn.drawAnimFrame),t.tmp.source_svg=void 0,t.tmp.img_obj=void 0,t.tmp.count_svg=0,t.fn.particlesEmpty(),t.fn.canvasClear(),t.fn.vendors.start()},t.fn.interact.linkParticles=function(e,i){var a=e.x-i.x,s=e.y-i.y,r=Math.sqrt(a*a+s*s);if(r<=t.particles.line_linked.distance){var n=t.particles.line_linked.opacity-r/(1/t.particles.line_linked.opacity)/t.particles.line_linked.distance;if(n>0){var c=t.particles.line_linked.color_rgb_line;t.canvas.ctx.strokeStyle="rgba("+c.r+","+c.g+","+c.b+","+n+")",t.canvas.ctx.lineWidth=t.particles.line_linked.width,t.canvas.ctx.beginPath(),t.canvas.ctx.moveTo(e.x,e.y),t.canvas.ctx.lineTo(i.x,i.y),t.canvas.ctx.stroke(),t.canvas.ctx.closePath()}}},t.fn.interact.attractParticles=function(e,i){var a=e.x-i.x,s=e.y-i.y;if(Math.sqrt(a*a+s*s)<=t.particles.line_linked.distance){var r=a/(1e3*t.particles.move.attract.rotateX),n=s/(1e3*t.particles.move.attract.rotateY);e.vx-=r,e.vy-=n,i.vx+=r,i.vy+=n}},t.fn.interact.bounceParticles=function(e,i){var a=e.x-i.x,t=e.y-i.y;Math.sqrt(a*a+t*t)<=e.radius+i.radius&&(e.vx=-e.vx,e.vy=-e.vy,i.vx=-i.vx,i.vy=-i.vy)},t.fn.modes.pushParticles=function(e,i){t.tmp.pushing=!0;for(var a=0;a<e;a++)t.particles.array.push(new t.fn.particle(t.particles.color,t.particles.opacity.value,{x:i?i.pos_x:Math.random()*t.canvas.w,y:i?i.pos_y:Math.random()*t.canvas.h})),a==e-1&&(t.particles.move.enable||t.fn.particlesDraw(),t.tmp.pushing=!1)},t.fn.modes.removeParticles=function(e){t.particles.array.splice(0,e),t.particles.move.enable||t.fn.particlesDraw()},t.fn.modes.bubbleParticle=function(e){if(t.interactivity.events.onhover.enable&&isInArray("bubble",t.interactivity.events.onhover.mode)){var i=e.x-t.interactivity.mouse.pos_x,a=e.y-t.interactivity.mouse.pos_y,s=Math.sqrt(i*i+a*a),r=1-s/t.interactivity.modes.bubble.distance;function n(){e.opacity_bubble=e.opacity,e.radius_bubble=e.radius}if(s<=t.interactivity.modes.bubble.distance){if(r>=0&&"mousemove"==t.interactivity.status){if(t.interactivity.modes.bubble.size!=t.particles.size.value){if(t.interactivity.modes.bubble.size>t.particles.size.value){var c=e.radius+t.interactivity.modes.bubble.size*r;c>=0&&(e.radius_bubble=c)}else{var o=e.radius-t.interactivity.modes.bubble.size,c=e.radius-o*r;c>0?e.radius_bubble=c:e.radius_bubble=0}}if(t.interactivity.modes.bubble.opacity!=t.particles.opacity.value){if(t.interactivity.modes.bubble.opacity>t.particles.opacity.value){var l=t.interactivity.modes.bubble.opacity*r;l>e.opacity&&l<=t.interactivity.modes.bubble.opacity&&(e.opacity_bubble=l)}else{var l=e.opacity-(t.particles.opacity.value-t.interactivity.modes.bubble.opacity)*r;l<e.opacity&&l>=t.interactivity.modes.bubble.opacity&&(e.opacity_bubble=l)}}}}else n();"mouseleave"==t.interactivity.status&&n()}else if(t.interactivity.events.onclick.enable&&isInArray("bubble",t.interactivity.events.onclick.mode)){if(t.tmp.bubble_clicking){var i=e.x-t.interactivity.mouse.click_pos_x,a=e.y-t.interactivity.mouse.click_pos_y,s=Math.sqrt(i*i+a*a),v=(new Date().getTime()-t.interactivity.mouse.click_time)/1e3;v>t.interactivity.modes.bubble.duration&&(t.tmp.bubble_duration_end=!0),v>2*t.interactivity.modes.bubble.duration&&(t.tmp.bubble_clicking=!1,t.tmp.bubble_duration_end=!1)}function p(i,a,r,n,c){if(i!=a){if(t.tmp.bubble_duration_end){if(void 0!=r){var o=n-v*(n-i)/t.interactivity.modes.bubble.duration;p=i+(i-o),"size"==c&&(e.radius_bubble=p),"opacity"==c&&(e.opacity_bubble=p)}}else if(s<=t.interactivity.modes.bubble.distance){if(void 0!=r)var l=r;else var l=n;if(l!=i){var p=n-v*(n-i)/t.interactivity.modes.bubble.duration;"size"==c&&(e.radius_bubble=p),"opacity"==c&&(e.opacity_bubble=p)}}else"size"==c&&(e.radius_bubble=void 0),"opacity"==c&&(e.opacity_bubble=void 0)}}t.tmp.bubble_clicking&&(p(t.interactivity.modes.bubble.size,t.particles.size.value,e.radius_bubble,e.radius,"size"),p(t.interactivity.modes.bubble.opacity,t.particles.opacity.value,e.opacity_bubble,e.opacity,"opacity"))}},t.fn.modes.repulseParticle=function(e){if(t.interactivity.events.onhover.enable&&isInArray("repulse",t.interactivity.events.onhover.mode)&&"mousemove"==t.interactivity.status){var i=e.x-t.interactivity.mouse.pos_x,a=e.y-t.interactivity.mouse.pos_y,s=Math.sqrt(i*i+a*a),r={x:i/s,y:a/s},n=t.interactivity.modes.repulse.distance,c=clamp(1/n*(-1*Math.pow(s/n,2)+1)*n*100,0,50),o={x:e.x+r.x*c,y:e.y+r.y*c};"bounce"==t.particles.move.out_mode?(o.x-e.radius>0&&o.x+e.radius<t.canvas.w&&(e.x=o.x),o.y-e.radius>0&&o.y+e.radius<t.canvas.h&&(e.y=o.y)):(e.x=o.x,e.y=o.y)}else if(t.interactivity.events.onclick.enable&&isInArray("repulse",t.interactivity.events.onclick.mode)){if(t.tmp.repulse_finish||(t.tmp.repulse_count++,t.tmp.repulse_count!=t.particles.array.length||(t.tmp.repulse_finish=!0)),t.tmp.repulse_clicking){var n=Math.pow(t.interactivity.modes.repulse.distance/6,3),l=t.interactivity.mouse.click_pos_x-e.x,v=t.interactivity.mouse.click_pos_y-e.y,p=l*l+v*v,d=-n/p*1;p<=n&&function i(){var a=Math.atan2(v,l);if(e.vx=d*Math.cos(a),e.vy=d*Math.sin(a),"bounce"==t.particles.move.out_mode){var s={x:e.x+e.vx,y:e.y+e.vy};s.x+e.radius>t.canvas.w?e.vx=-e.vx:s.x-e.radius<0&&(e.vx=-e.vx),s.y+e.radius>t.canvas.h?e.vy=-e.vy:s.y-e.radius<0&&(e.vy=-e.vy)}}()}else!1==t.tmp.repulse_clicking&&(e.vx=e.vx_i,e.vy=e.vy_i)}},t.fn.modes.grabParticle=function(e){if(t.interactivity.events.onhover.enable&&"mousemove"==t.interactivity.status){var i=e.x-t.interactivity.mouse.pos_x,a=e.y-t.interactivity.mouse.pos_y,s=Math.sqrt(i*i+a*a);if(s<=t.interactivity.modes.grab.distance){var r=t.interactivity.modes.grab.line_linked.opacity-s/(1/t.interactivity.modes.grab.line_linked.opacity)/t.interactivity.modes.grab.distance;if(r>0){var n=t.particles.line_linked.color_rgb_line;t.canvas.ctx.strokeStyle="rgba("+n.r+","+n.g+","+n.b+","+r+")",t.canvas.ctx.lineWidth=t.particles.line_linked.width,t.canvas.ctx.beginPath(),t.canvas.ctx.moveTo(e.x,e.y),t.canvas.ctx.lineTo(t.interactivity.mouse.pos_x,t.interactivity.mouse.pos_y),t.canvas.ctx.stroke(),t.canvas.ctx.closePath()}}}},t.fn.vendors.eventsListeners=function(){"window"==t.interactivity.detect_on?t.interactivity.el=window:t.interactivity.el=t.canvas.el,(t.interactivity.events.onhover.enable||t.interactivity.events.onclick.enable)&&(t.interactivity.el.addEventListener("mousemove",function(e){if(t.interactivity.el==window)var i=e.clientX,a=e.clientY;else var i=e.offsetX||e.clientX,a=e.offsetY||e.clientY;t.interactivity.mouse.pos_x=i,t.interactivity.mouse.pos_y=a,t.tmp.retina&&(t.interactivity.mouse.pos_x*=t.canvas.pxratio,t.interactivity.mouse.pos_y*=t.canvas.pxratio),t.interactivity.status="mousemove"}),t.interactivity.el.addEventListener("mouseleave",function(e){t.interactivity.mouse.pos_x=null,t.interactivity.mouse.pos_y=null,t.interactivity.status="mouseleave"})),t.interactivity.events.onclick.enable&&t.interactivity.el.addEventListener("click",function(){if(t.interactivity.mouse.click_pos_x=t.interactivity.mouse.pos_x,t.interactivity.mouse.click_pos_y=t.interactivity.mouse.pos_y,t.interactivity.mouse.click_time=new Date().getTime(),t.interactivity.events.onclick.enable)switch(t.interactivity.events.onclick.mode){case"push":t.particles.move.enable?t.fn.modes.pushParticles(t.interactivity.modes.push.particles_nb,t.interactivity.mouse):1==t.interactivity.modes.push.particles_nb?t.fn.modes.pushParticles(t.interactivity.modes.push.particles_nb,t.interactivity.mouse):t.interactivity.modes.push.particles_nb>1&&t.fn.modes.pushParticles(t.interactivity.modes.push.particles_nb);break;case"remove":t.fn.modes.removeParticles(t.interactivity.modes.remove.particles_nb);break;case"bubble":t.tmp.bubble_clicking=!0;break;case"repulse":t.tmp.repulse_clicking=!0,t.tmp.repulse_count=0,t.tmp.repulse_finish=!1,setTimeout(function(){t.tmp.repulse_clicking=!1},1e3*t.interactivity.modes.repulse.duration)}})},t.fn.vendors.densityAutoParticles=function(){if(t.particles.number.density.enable){var e=t.canvas.el.width*t.canvas.el.height/1e3;t.tmp.retina&&(e/=2*t.canvas.pxratio);var i=e*t.particles.number.value/t.particles.number.density.value_area,a=t.particles.array.length-i;a<0?t.fn.modes.pushParticles(Math.abs(a)):t.fn.modes.removeParticles(a)}},t.fn.vendors.checkOverlap=function(e,i){for(var a=0;a<t.particles.array.length;a++){var s=t.particles.array[a],r=e.x-s.x,n=e.y-s.y;Math.sqrt(r*r+n*n)<=e.radius+s.radius&&(e.x=i?i.x:Math.random()*t.canvas.w,e.y=i?i.y:Math.random()*t.canvas.h,t.fn.vendors.checkOverlap(e))}},t.fn.vendors.createSvgImg=function(e){var i,a=t.tmp.source_svg;i=(i=e.img.replace_color?"data:image/svg+xml;utf8,"+a.replace(/#([0-9A-F]{3,6})/gi,function(i,a,t,s){if(e.color.rgb)var r="rgba("+e.color.rgb.r+","+e.color.rgb.g+","+e.color.rgb.b+","+e.opacity+")";else var r="hsla("+e.color.hsl.h+","+e.color.hsl.s+"%,"+e.color.hsl.l+"%,"+e.opacity+")";return r}):"data:image/svg+xml;utf8,"+a).replace("#rgb","rgb");var s=new Image;s.addEventListener("load",function(){e.img.obj=s,e.img.loaded=!0,t.tmp.count_svg=(t.tmp.count_svg||0)+1}),s.src=i},t.fn.vendors.destroypJS=function(){cancelAnimationFrame(t.fn.drawAnimFrame),a.remove(),pJSDom=null},t.fn.vendors.drawShape=function(e,i,a,t,s,r){var n=s*r,c=s/r,o=Math.PI-Math.PI*(180*(c-2)/c)/180;e.save(),e.beginPath(),e.translate(i,a),e.moveTo(0,0);for(var l=0;l<n;l++)e.lineTo(t,0),e.translate(t,0),e.rotate(o);e.fill(),e.restore()},t.fn.vendors.exportImg=function(){window.open(t.canvas.el.toDataURL("image/png"),"_blank")},t.fn.vendors.loadImg=function(e){if(t.tmp.img_error=void 0,""!=t.particles.shape.image.src){if("svg"==e){var i=new XMLHttpRequest;i.open("GET",t.particles.shape.image.src),i.onreadystatechange=function(e){4==i.readyState&&(200==i.status?(t.tmp.source_svg=e.currentTarget.response,t.fn.vendors.checkBeforeDraw()):(console.log("Error pJS - Image not found"),t.tmp.img_error=!0))},i.send()}else{var a=new Image;a.addEventListener("load",function(){t.tmp.img_obj=a,t.fn.vendors.checkBeforeDraw()}),a.src=t.particles.shape.image.src}}else console.log("Error pJS - No image.src"),t.tmp.img_error=!0},t.fn.vendors.draw=function(){"image"==t.particles.shape.type?"svg"==t.tmp.img_type?t.tmp.count_svg>=t.particles.number.value?(t.fn.particlesDraw(),t.particles.move.enable?t.fn.drawAnimFrame=requestAnimFrame(t.fn.vendors.draw):cancelRequestAnimFrame(t.fn.drawAnimFrame)):t.tmp.img_error||(t.fn.drawAnimFrame=requestAnimFrame(t.fn.vendors.draw)):void 0!=t.tmp.img_obj?(t.fn.particlesDraw(),t.particles.move.enable?t.fn.drawAnimFrame=requestAnimFrame(t.fn.vendors.draw):cancelRequestAnimFrame(t.fn.drawAnimFrame)):t.tmp.img_error||(t.fn.drawAnimFrame=requestAnimFrame(t.fn.vendors.draw)):(t.fn.particlesDraw(),t.particles.move.enable?t.fn.drawAnimFrame=requestAnimFrame(t.fn.vendors.draw):cancelRequestAnimFrame(t.fn.drawAnimFrame))},t.fn.vendors.checkBeforeDraw=function(){"image"==t.particles.shape.type?"svg"==t.tmp.img_type&&void 0==t.tmp.source_svg?t.tmp.checkAnimFrame=requestAnimFrame(check):(cancelRequestAnimFrame(t.tmp.checkAnimFrame),t.tmp.img_error||(t.fn.vendors.init(),t.fn.vendors.draw())):(t.fn.vendors.init(),t.fn.vendors.draw())},t.fn.vendors.init=function(){t.fn.retinaInit(),t.fn.canvasInit(),t.fn.canvasSize(),t.fn.canvasPaint(),t.fn.particlesCreate(),t.fn.vendors.densityAutoParticles(),t.particles.line_linked.color_rgb_line=hexToRgb(t.particles.line_linked.color)},t.fn.vendors.start=function(){isInArray("image",t.particles.shape.type)?(t.tmp.img_type=t.particles.shape.image.src.substr(t.particles.shape.image.src.length-3),t.fn.vendors.loadImg(t.tmp.img_type)):t.fn.vendors.checkBeforeDraw()},t.fn.vendors.eventsListeners(),t.fn.vendors.start()};function hexToRgb(e){e=e.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i,function(e,i,a,t){return i+i+a+a+t+t});var i=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e);return i?{r:parseInt(i[1],16),g:parseInt(i[2],16),b:parseInt(i[3],16)}:null}function clamp(e,i,a){return Math.min(Math.max(e,i),a)}function isInArray(e,i){return i.indexOf(e)>-1}Object.deepExtend=function(e,i){for(var a in i)i[a]&&i[a].constructor&&i[a].constructor===Object?(e[a]=e[a]||{},arguments.callee(e[a],i[a])):e[a]=i[a];return e},window.requestAnimFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(e){window.setTimeout(e,1e3/60)},window.cancelRequestAnimFrame=window.cancelAnimationFrame||window.webkitCancelRequestAnimationFrame||window.mozCancelRequestAnimationFrame||window.oCancelRequestAnimationFrame||window.msCancelRequestAnimationFrame||clearTimeout,window.pJSDom=[],window.particlesJS=function(e,i){"string"!=typeof e&&(i=e,e="particles-js"),e||(e="particles-js");var a=document.getElementById(e),t="particles-js-canvas-el",s=a.getElementsByClassName(t);if(s.length)for(;s.length>0;)a.removeChild(s[0]);var r=document.createElement("canvas");r.className=t,r.style.width="100%",r.style.height="100%",null!=document.getElementById(e).appendChild(r)&&pJSDom.push(new pJS(e,i))},window.particlesJS.load=function(e,i,a){var t=new XMLHttpRequest;t.open("GET",i),t.onreadystatechange=function(i){if(4==t.readyState){if(200==t.status){var s=JSON.parse(i.currentTarget.response);window.particlesJS(e,s),a&&a()}else console.log("Error pJS - XMLHttpRequest status: "+t.status),console.log("Error pJS - File config not found")}},t.send()};