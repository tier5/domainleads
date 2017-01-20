


		{!! Html::style('resources/assets/css/bootstrap.css') !!}
		<!-- {!! Html::style('resources/assets/css/jquery.dataTables.css') !!} -->
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		{!! Html::script('resources/assets/js/bootstrap.js') !!}
		<!-- {!! Html::script('resources/assets/js/jquery.dataTables.js') !!} -->
		

				

            <div class="container">
                <div class="content">
					@foreach($products as $product)
					{{$product->name}}
					@endforeach
					{{$products->links()}}
				</div>	
			</div>
					<script>
				/*==================== PAGINATION =========================*/

				$(window).on('hashchange',function(){
					page = window.location.hash.replace('#','');
					getProducts(page);
				});

				$(document).on('click','.pagination a', function(e){
					e.preventDefault();
					var page = $(this).attr('href').split('page=')[1];
					// getProducts(page);
					location.hash = page;
				});

				function getProducts(page){

					$.ajax({
						url: 'ajax/product?page=' + page
					}).done(function(data){
						$('.content').html(data);
					});
				}

				</script>
<script type="text/javascript">
//$(document).ready(function(){
//$('.product22').DataTable({

 // select:true,
 // "order":[[0,"desc"]],
 // "paging" :true,
 // "bProcessing":true
  
//});
//});
</script>


