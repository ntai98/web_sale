<div id="showContainer">
                            <div class="navButton" id="previous">&#10094;</div>

                            <div class="imageContainer" id="im_1">
                            <?php

							$jsondatanb = file_get_contents('http://localhost/banhang/api/noibac');
									$jsonnb = json_decode($jsondatanb,true);
							foreach( $jsonnb as $np){
								if($np['thutu'] < 5){
								    $link =  'http://localhost/banhang/api/hanghoa/' .$np['mahang'];
                                    $jsondatahh = file_get_contents($link);
                                    $hh = json_decode($jsondatahh,true);
                                    echo "<div class=\"spnb\">";
                                    echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"><img src=\"hinh/" .$hh['hinh']
                                        ."\" width=\"100%\" height=\"280px\"   ></a>" );
                                    echo"<br>";
                                    echo"<br>";

                                    echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"> " .$hh['tenhang'] ."</a>" );
                                    echo"<br>";
                                    echo"<br>";
                                    echo("<p align=\"center\">" .$hh['gia'] ."VNĐ" ."</p>");
                                    echo "</div>";
									
								}
							}

                        ?>
                            </div>

                            <div class="imageContainer" id="im_2">
                            <?php
                            foreach( $jsonnb as $np){
                                if($np['thutu'] >= 5 && $np['thutu'] < 9){
                                    $link =  'http://localhost/banhang/api/hanghoa/' .$np['mahang'];
                                    $jsondatahh = file_get_contents($link);
                                    $hh = json_decode($jsondatahh,true);
                                    echo "<div class=\"spnb\">";
                                    echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"><img src=\"hinh/" .$hh['hinh']
                                        ."\" width=\"100%\" height=\"280px\"   ></a>" );
                                    echo"<br>";
                                    echo"<br>";

                                    echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"> " .$hh['tenhang'] ."</a>" );
                                    echo"<br>";
                                    echo"<br>";
                                    echo("<p align=\"center\">" .$hh['gia'] ."VNĐ" ."</p>");
                                    echo "</div>";

                                }
                            }
                            
                        ?>
                            
                            </div>

                            <div class="imageContainer" id="im_3">
                           <?php
                           foreach( $jsonnb as $np){
                               if($np['thutu'] > 8){
                                   $link =  'http://localhost/banhang/api/hanghoa/' .$np['mahang'];
                                   $jsondatahh = file_get_contents($link);
                                   $hh = json_decode($jsondatahh,true);
                                   echo "<div class=\"spnb\">";
                                   echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"><img src=\"hinh/" .$hh['hinh']
                                       ."\" width=\"100%\" height=\"280px\"   ></a>" );
                                   echo"<br>";
                                   echo"<br>";

                                   echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"> " .$hh['tenhang'] ."</a>" );
                                   echo"<br>";
                                   echo"<br>";
                                   echo("<p align=\"center\">" .$hh['gia'] ."VNĐ" ."</p>");
                                   echo "</div>";

                               }
                           }

                        ?>
                            
                            </div>
                            <div class="navButton" id="next">&#10095;</div>