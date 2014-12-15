<!-- Start footer -->
<div class="footer_container">
	<div class="footer clearfix">
		<div class="row">
				<div class="column column_3_4">
				<ul class="footer_menu">
					<li>
		            <h4><a href="{{URL::to('/')}}" title="Home">Trang chủ</a></h4>
		        </li>
		        <li>
		            <h4><a href="{{URL::to('/video').'.html'}}" title="video">Video</a></h4>
	            </li>
				 	<?
		            if(!empty($dataNavHeader)){
		                foreach($dataNavHeader as $nav){
		                    $link_category = URL::to('/bai-viet/'.$nav->cat_id.'-'.Str::slug($nav->cat_name)).'.html';
		         ?>
		            <li>
		                <h4><a href="{{$link_category}}" title="{{$nav->cat_name}}">{{$nav->cat_name}}</a></h4>
		            </li>
		         <?}}?>
		         <li>
		            <h4><a href="{{URL::to('/games').'.html'}}" title="games">Games</a></h4>
	            </li>
				</ul>
			</div>
			<div class="column column_1_4">
				<a class="scroll_top" href="#top" title="Scroll to top">Top</a>
			</div>
		</div>

		<div class="row copyright_row">
			<div class="column column_3_4">
				© Copyright <a href="{{URL::to('/')}}" title="QuanticaLabs" target="_blank"> nongtungphut.com</a>
			</div>
			<div class="column column_1_4">
					<ul class="social_icons dark clearfix" style="float: right">
					<li>
						<a target="_blank" title="" href="http://facebook.com" class="social_icon facebook">
							&nbsp;
						</a>
					</li>
					<li>
						<a target="_blank" title="" href="https://twitter.com" class="social_icon twitter">
							&nbsp;
						</a>
					</li>
					 <li>
	                <a href="mailto:contact@gmail.com" class="social_icon mail" title="mail">
	                    &nbsp;
	                </a>
	            </li>
					<li>
						<a title="" href="#" class="social_icon skype">
							&nbsp;
						</a>
					</li>
					<li>
						<a title="" href="#" class="social_icon instagram">
							&nbsp;
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End Footer -->