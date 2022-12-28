<?php 
                                                $url = "http://uat.dhansewa.com/Common/GetState";                                                       $ch = curl_init($url);curl_setopt($ch, CURLOPT_URL, $url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);$result = curl_exec($ch);curl_close($ch);
                                                                        
                                                                        echo $result;
                                                                        ?>