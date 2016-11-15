                    $timeInIndex = 0;
                    $storeInIndex = 0;
                    $timeOutIndex = 0;                    
                    $storeOutIndex = 0;


                    for($timeIndex = 0; $timeIndex < count($timeArray); $timeIndex += 2){
                        if($timeArray[$timeIndex] != ""){
                            // echo " store in: ".$timeArray[$timeIndex]; // temp array for database
                            
                            $timeIn[$storeInIndex] = $timeArray[$timeIndex];
                            $storeInIndex++;

                            $matchFound = false;
                            for($timeOutIndex = $timeIndex + 1; $matchFound == false && $timeOutIndex < count($timeArray); $timeOutIndex += 2){
                                if($timeArray[$timeOutIndex] != ""){
                                    // echo " store out: ".$timeArray[$timeOutIndex];

                                    $timeOut[$storeOutIndex] = $timeArray[$timeOutIndex];
                                    $storeOutIndex++;

                                    $timeIndex = $timeOutIndex - 1;
                                    if($timeOutIndex < count($timeArray) - 2){                                        
                                        if( $timeIn[$storeInIndex - 1] != $timeArray[$timeOutIndex - 1] &&
                                            count($timeIn) < 2 && $timeArray[$timeOutIndex + 1] == ""){
                                            // echo " in before matching out: ".$timeArray[$timeOutIndex - 1]." ";
                                            $timeIn[$storeInIndex] = $timeArray[$timeIndex];
                                            $storeInIndex++;                                        
                                        }

                                    }
                                    $matchFound = true;
                                }
                            }

                            if($matchFound == false){
                                echo " ".$dtrsName.", you have a time in without a matching time out. <br />";
                            }

                        }
                        else{                            

                            $matchFound = false;                            
                            for($timeInIndex = $timeIndex; $matchFound == false && $timeInIndex < count($timeArray); $timeInIndex += 2){
                                if($timeArray[$timeInIndex] != ""){
                                    $matchFound = true;

                                    if($timeIndex == 0 && $timeArray[$timeInIndex -1] != ""){
                                        // echo " out without matching in: ".$timeArray[$timeInIndex -1];

                                        $timeOut[$storeOutIndex] = $timeArray[$timeInIndex - 1];
                                        $storeOutIndex++;                                        

                                        echo "<br />".$dtrsName.", you did not log in on: ".$formattedDate."<br/>";
                                    }
                                }
                            }

                            if($matchFound == false){
                                for($timeOutIndex = $timeIndex + 1; $matchFound == false && $timeOutIndex < count($timeArray); $timeOutIndex += 2){
                                    if($timeArray[$timeOutIndex] != ""){
                                        // echo " store out(last): ".$timeArray[$timeOutIndex];
                                        echo "<br />";
                                        $timeOut[$storeOutIndex] = $timeArray[$timeOutIndex];
                                        $storeOutIndex++;

                                        $timeIndex = $timeOutIndex - 1;
                                        $matchFound = true;
                                    }                                    
                                }
                            }
                        }
                    }