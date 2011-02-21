<!--[if !IE]>start sidebar<![endif]-->
			<div id="sidebar">
				<div class="inner">
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Category Menu</h2>
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
													  echo $this->Html->link("List", array(
													    "controller" => "categories",
													    "action" => "index"
													  ), array("class" => "sm-list")) ?></li>
                                                    <li>
                                                    <?php
                                                    echo $this->Html->link("Create", array(
                                                      "controller" => "categories",
                                                      "action" => "add",
                                                      (isset($parent_id) ? $parent_id : null)
                                                    ), array("class" => "sm-add")) ?></li>
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

          <div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Quick Info</h2>
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

													<div class="todo_list">
														<dl>
															<dt><span class="order">1</span> Category with none parent</dt>
															<dd>
																it is a category in the top hierarchy.
															</dd>
														</dl>

														<dl>
															<dt><span class="order">2</span> Category with parent</dt>
															<dd>
																is a category that will be subcategory of selected parent.
															</dd>
														</dl>

                            <dl>
															<dt><span class="order">3</span> Moves Arrows</dt>
															<dd>
																the arrows are used to reindex or sort item index on displayed list.
															</dd>
														</dl>

                            <dl>
															<dt><span class="order">4</span> Delete Button</dt>
															<dd>
																it will remove all dependencies data up to the last child inheritantly.
															</dd>
														</dl>

                            <dl>
															<dt><span class="order">5</span> Published Checkbox</dt>
															<dd>
																it is used to show or hide your category with its children and products.
															</dd>
														</dl>

                            <dl>
															<dt><span class="order">6</span> Background Color</dt>
															<dd>
																it is used to colorize category tab's background.
															</dd>
														</dl>

                            <dl class="last">
															<dt><span class="order">7</span> Slug</dt>
															<dd>
																it is used to make user SEO url based on category title (automatically generated from title).
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
