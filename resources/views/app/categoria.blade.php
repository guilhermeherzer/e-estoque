<!DOCTYPE html>
<html lang="pt" style="height: 100% !important">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>e-Com App</title>
		<!-- Custom fonts for this template-->
		<link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<!-- Custom styles for this template-->
		<link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
	</head>
	<body class="flex-box text-center">
		<style type="text/css">
			.flex-box {
				min-height: 100% !important;
			  	display: flex !important;
			  	align-items: center !important;
			  	justify-content: center !important;
			}

			.shadow-lg {
				border-radius: 10px;
			}

			.texto {
				margin: 0;
				font-size: 18pt;
			}

			.texto-box {
				height: 50px;
			}

			a {
				cursor: pointer;
				color: black;
				text-decoration: none !important;
			}
		</style>

		<style type="text/css">
			.MultiCarousel {
				float: left;
				overflow: hidden;
				padding: 15px;
				width: 100%;
				position:relative;
				background-color: #f2f2f2;
			}

		    .MultiCarousel .MultiCarousel-inner {
		    	transition: 1s ease all;
		    	float: left;
		    }

		    /**********************************************************************/

		    /* Itens */

		    .MultiCarousel .MultiCarousel-inner .item {
		    	float: left;
		    	text-align: center;
		    	padding: 10px;
		    	background-color: white;
		    	color: black;
		    }

		    /* Fim Itens */

		    /**********************************************************************/

		    /* Botões para os lados */

		    .MultiCarousel .leftLst, .MultiCarousel .rightLst {
		    	position: absolute;
		    	border-radius: 50%;
		    	top: calc(50% - 20px);
		    }

		    .MultiCarousel .leftLst {
		    	left:0;
		    }

		    .MultiCarousel .rightLst {
		    	right:0;
		    }
	    
	        .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over {
	        	pointer-events: none;
	        	background: #ccc;
	        }

	        /* Fim Botões para os lados */

	        /***********************************************************************/

	        .MultiCarousel img {
	        	width: 60px;
	        	height: 130px;
	        }

	        .MultiCarousel p {
	        	margin: 0px;
	        	font-weight: bold;
	        }
		</style>
	    <div class="container">
	        <!-- Outer Row -->
	        <div class="row justify-content-center">
	        	@foreach($data['produtoData'] as $p)
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
			        <h1>{{ $p['marca'] }}</h1>
			        <div class="MultiCarousel-inner">
			        	@foreach($p['produtos'] as $p)
				            <div class="item" >
			                    <img src="{{ asset($p->img) }}">
			                    <p>{{ $p->nome }}</p>
			                    <p>R$ {{ n($p->preco_loja) }}</p>
				            </div>
			            @endforeach
			        </div>
			        <button class="btn btn-primary leftLst"><</button>
			        <button class="btn btn-primary rightLst">></button>
			    </div>
			    @endforeach
	        </div>
	    </div>
		<!-- Bootstrap core JavaScript-->
		<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- Core plugin JavaScript-->
		<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
		<!-- Custom scripts for all pages-->
		<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
		<!-- Core plugin DataTables-->
		<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
		<!-- Mensagem Modal -->
		@if(Session::has('mensagem'))
			<script type="text/javascript">
				$(document).ready(function(){
					$('#mensagemModal').modal('show');
				});
			</script>
		@endif
		<script type="text/javascript">
			$(document).ready(function () {
		    var itemsMainDiv = ('.MultiCarousel');
		    var itemsDiv = ('.MultiCarousel-inner');
		    var itemWidth = "";

		    $('.leftLst, .rightLst').click(function () {
		        var condition = $(this).hasClass("leftLst");
		        if (condition)
		            click(0, this);
		        else
		            click(1, this)
		    });

		    ResCarouselSize();




		    $(window).resize(function () {
		        ResCarouselSize();
		    });

		    //this function define the size of the items
		    function ResCarouselSize() {
		        var incno = 0;
		        var dataItems = ("data-items");
		        var itemClass = ('.item');
		        var id = 0;
		        var btnParentSb = '';
		        var itemsSplit = '';
		        var sampwidth = $(itemsMainDiv).width();
		        var bodyWidth = $('body').width();
		        $(itemsDiv).each(function () {
		            id = id + 1;
		            var itemNumbers = $(this).find(itemClass).length;
		            btnParentSb = $(this).parent().attr(dataItems);
		            itemsSplit = btnParentSb.split(',');
		            $(this).parent().attr("id", "MultiCarousel" + id);


		            if (bodyWidth >= 1200) {
		                incno = itemsSplit[3];
		                itemWidth = sampwidth / incno;
		            }
		            else if (bodyWidth >= 992) {
		                incno = itemsSplit[2];
		                itemWidth = sampwidth / incno;
		            }
		            else if (bodyWidth >= 768) {
		                incno = itemsSplit[1];
		                itemWidth = sampwidth / incno;
		            }
		            else {
		                incno = itemsSplit[0];
		                itemWidth = sampwidth / incno;
		            }
		            $(this).css({ 'transform': 'translateX(0px)', 'width': (itemWidth * itemNumbers) + (10 * (itemNumbers - 1)) });
		            $(this).find(itemClass).each(function () {
		                $(this).outerWidth(itemWidth);
		            });

		            $(".leftLst").addClass("over");
		            $(".rightLst").removeClass("over");

		        });
		    }


		    //this function used to move the items
		    function ResCarousel(e, el, s) {
		        var leftBtn = ('.leftLst');
		        var rightBtn = ('.rightLst');
		        var translateXval = '';
		        var divStyle = $(el + ' ' + itemsDiv).css('transform');
		        var values = divStyle.match(/-?[\d\.]+/g);
		        var xds = Math.abs(values[4]);
		        if (e == 0) {
		            translateXval = parseInt(xds) - parseInt(itemWidth * s);
		            $(el + ' ' + rightBtn).removeClass("over");

		            if (translateXval <= itemWidth / 2) {
		                translateXval = 0;
		                $(el + ' ' + leftBtn).addClass("over");
		            }
		        }
		        else if (e == 1) {
		            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
		            translateXval = parseInt(xds) + parseInt(itemWidth * s);
		            $(el + ' ' + leftBtn).removeClass("over");

		            if (translateXval >= itemsCondition - itemWidth / 2) {
		                translateXval = itemsCondition;
		                $(el + ' ' + rightBtn).addClass("over");
		            }
		        }
		        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
		    }

		    //It is used to get some elements from btn
		    function click(ell, ee) {
		        var Parent = "#" + $(ee).parent().attr("id");
		        var slide = $(Parent).attr("data-slide");
		        ResCarousel(ell, Parent, slide);
		    }

		});
		</script>
	</body>
</html>