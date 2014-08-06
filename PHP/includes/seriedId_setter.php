<?php
if(isset ($_GET['seriesId']) && !empty ($_GET['seriesId']))
            {
                $seriesId=$_GET['seriesId'];
                if(@$result=mysql_query("SELECT name from series_data where id=$seriesId LIMIT 1"))
                {
                    if(mysql_num_rows($result)!=1)
                    {
                        if($result=mysql_query("SELECT id from series_data where series_priority like 'main'"))
                        {
                           while($row=mysql_fetch_array($result)){  //to get all data.....
                           $id=mysql_real_escape_string($row['id']);
                           $seriesId=$id;
                        }
                       }
                    }
                }
            }
            else
                {
                     if(@$result=mysql_query("SELECT id from series_data where series_priority like 'main'"))
                     {
                        while(@$row=mysql_fetch_array($result)){  //to get all data.....
                        @$id=mysql_real_escape_string($row['id']);
                        @$seriesId=$id;
                     }
                    }
                }
?>
