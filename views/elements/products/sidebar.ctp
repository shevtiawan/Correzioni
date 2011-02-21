<!--[if !IE]>start sidebar<![endif]-->
			<div id="sidebar">
				<div class="inner">
          <?php
          
            if($this->params['controller'] == "product_galleries"){
              //echo $this->element('product_galleries/photo_box');
              echo $this->element('product_galleries/sidebar');
            }
            
            if($this->params['controller'] == "product_ratings"){
              echo $this->element('product_ratings/sidebar');
            }
            
            if($this->params['controller'] == "product_services"){
              echo $this->element('product_services/sidebar');
            }
            
          ?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Product Menu</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">
												<ul class="sidebar_menu">
												  <li>
												    <?php
												      $url = array(
													    "controller" => "products",
													    "action" => "index"
												      );
												      if (isset($parent_id)) {
												          $url['action'] = 'tabs';
												          $url['admin'] = true;
												          $url['parent_id'] = $parent_id;
												      }
													  echo $this->Html->link(
													    "List ",
													    $url,
													    array("class" => "sm-list")
													  );
													?>
												  </li>
                          <li><?php echo $this->Html->link("Create ", array("controller" => "products", "action" => "add", (isset($parent_id) ? $parent_id : null)), array("class" => "sm-add")) ?></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
					<!--[if !IE]>end section<![endif]-->

			        <!--[if !IE]>start section<![endif]-->
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Search Product</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<?php echo $this->element('products/search_form'); ?>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
					<!--[if !IE]>end section<![endif]-->

          <!--[if !IE]>start section<![endif]-->
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>To do list</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
					<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">

													<div class="todo_list">
														<dl>
															<dt><span class="order">1</span> Parent</dt>
															<dd>
																it is used to create tab, if you want create new tab, you should select a parent which is a product's of its tab.
															</dd>
														</dl>

													</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->

						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
					<!--[if !IE]>end section<![endif]-->
				</div>
			</div>
			<!--[if !IE]>end sidebar<![endif]-->
