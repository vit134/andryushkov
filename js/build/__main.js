/*  eslint camelcase: 0 */

$(document).ready(function() {

    var $lWindow = $('.js-l-window')
      , progressBar = $('.js-circle-progress')
      , $mainmenu = $('.js-main-menu')
      , $toplineMenuButton = $('.js-main-menu-button')
      , $closeMainMenuButton = $('.js-close-main-menu')
      ;

    function init() {
        bindEvents();
        createCircle();
    }

    function bindEvents() {
        $toplineMenuButton.on('click', function() {
            $mainmenu.addClass('open');
            $lWindow.addClass('open')
        })

        $closeMainMenuButton.on('click', function() {
            $mainmenu.removeClass('open');
            $lWindow.removeClass('open')
        })
    }

    function createCircle() {
        progressBar.each(function() {
            var el = $(this).find('.graph').get(0);

            var options = {
                percent: el.getAttribute('data-percent') * 10 || 25,
                size: el.getAttribute('data-size') || 220,
                lineWidth: el.getAttribute('data-line') || 5,
                rotate: el.getAttribute('data-rotate') || 0,
                colorOut: el.getAttribute('data-colorOut') || 'rgba(255,255,255, 0.8)',
                colorLine: el.getAttribute('data-colorLine') || '#000'
            }
            var fps = 1000 / 200;
            var canvas = document.createElement('canvas');
            var span = document.createElement('span');
            span.textContent = options.percent / 10;
            var G_vmlCanvasManager;

            if (typeof(G_vmlCanvasManager) !== 'undefined') {
                G_vmlCanvasManager.initElement(canvas);
            }

            var ctx = canvas.getContext('2d');
            canvas.width = canvas.height = options.size;

            el.appendChild(span);
            el.appendChild(canvas);

            var radius = (options.size - options.lineWidth) / 2;
            var posX = canvas.width / 2,
                posY = canvas.height / 2,
                oneProcent = 360 / 100,
                result = oneProcent * options.percent,
                procent = 0;

            ctx.lineCap = 'round';
            arcMove();

            function arcMove(){
                var deegres = 0;
                var acrInterval = setInterval (function() {
                    deegres += 1;

                    procent = deegres / oneProcent;
                    //span.innerHTML = procent.toFixed();

                    ctx.clearRect( 0, 0, canvas.width, canvas.height );

                    ctx.beginPath();
                    ctx.arc( posX, posY, radius, (Math.PI/180) * radius, (Math.PI/180) * (radius + 360) );
                    ctx.strokeStyle = options.colorOut;
                    ctx.lineWidth = options.lineWidth;
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.strokeStyle = options.colorLine;
                    ctx.lineWidth = options.lineWidth;
                    ctx.arc( posX, posY, radius, (Math.PI/180) * radius, (Math.PI/180) * (radius + deegres) );
                    ctx.stroke();

                    if ( deegres >= result ) clearInterval(acrInterval);
                }, fps);
            }
        })
    }



    init();


})