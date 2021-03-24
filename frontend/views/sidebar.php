<div id="sidebar">
            <h3>Categories</h3>
            <div class="mobile-element">
                <select onchange="document.location=this.value">
                    <option>All</option>
                    <optgroup label="Fiction & Literature">
                        <option value="#Children">Children</option>
                        <option value="#Science">Science Fiction</option>
                        <option value="#">Fantasy</option>
                        <option value="#">Mystery</option>
                        <option value="#">Romance</option>
                    </optgroup>
                    <optgroup label="Non - Fiction">
                        <option value="#Children">Children</option>
                        <option value="#Science">Science Fiction</option>
                        <option value="#">Fantasy</option>
                        <option value="#">Mystery</option>
                        <option value="#">Romance</option>
                    </optgroup>
                </select>
            </div>
            <div class="categories desktop-element">
                <div class="categories-group">
                    <ul>
                        <li class="active"><a href="#">All</a></li>
                    </ul>
                </div>
				
                <?php  foreach(CategoryService::getCategoriesForSidebar() as $group => $categories) : ?>
                <div class="categories-group">
                    <h4><?=$group?></h4>
                    <ul>
						<?php  foreach($categories as $category) : ?>
							<li><a href="/frontend/index.php/?model=product&action=all&category_id=<?=$category['id']?>"><?=$category['title']?></a></li>
						<?php endforeach; ?>
                    </ul>
                </div>
				<?php endforeach; ?>
            </div>
		</div>