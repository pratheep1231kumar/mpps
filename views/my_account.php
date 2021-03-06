
<!-- Header starts -->
<?php include_once("header.php"); ?>
<script src="../js/my_account.js" type="text/javascript" charset="utf-8"></script>
<link type="text/css" href="../css/datatable_jui.css" media="all" rel="stylesheet"/>
<script type='text/javascript' src="../js/jquery.dataTables.js"></script>
<!-- Header ends -->

<div id="inner_content">
<div id="my_account_div">
 	<h2>My Log In</h2>
   	<div id="login_user_form" class="left_div_form">
    	<div id="id_error" class="error_note display_none"></div>
    	<div class="field_header"><h5>Log In:</h5></div>
        <form id="login_form" method="post" name="login_form" action>
        	<fieldset class="mpps_field_style">
        		<input type="text" title = "User Name"  placeholder = "User Name (Email Id)" name="user_name" id="id_user_name" 
                	maxlength="50" class="mpps_input_full mandatory">
                </br>
				<input type="password" title = "Password" placeholder = "Password" name="password" id="id_password" maxlength="50"
                	 class="mpps_input_full mandatory">
                </br>                
             </fieldset>             
        </form>
        <div id="login_button_div">
	        <input id='id_login' class="btn_dblue ui-button ui-widget ui-state-default ui-corner-all" type="button" value="Log In" 
                	name="login" role="button" aria-disabled="false">
        </div>
    </div>
    
	<!--<div id="create_user_form">    	
    	<div class="field_header"><h5>New to MPPS ?</h5></div>
        <form id="create_form" method="post" name="create_user_form" action>
        	<fieldset class="mpps_field_style">
            	<div class="clear"></div>
                <input type="text" title = "First Name" value placeholder = "First Name" name="first_name" id="first_name_value" maxlength="25" class="mpps_input" x-webkit-speech>
				<input type="text" title = "Last Name" value placeholder = "Last Name" name="last_name" id="last_name_value" maxlength="25" class="mpps_input" x-webkit-speech>
                </br>
				<input type="text" title = "User Name" value placeholder = "User Name (Email Id)" name="user_name" id="user_name_value" maxlength="25" class="mpps_input_full">
                </br>
				<input type="text" title = "Password" value placeholder = "Password" name="password" id="password_value" maxlength="25" class="mpps_input_full">
                </br>
				<input type="text" title = "Re-enter Password" value placeholder = "Re-enter Password" name="re_password" id="re_password_value" maxlength="25" class="mpps_input_full">
                </br>                
				<input type="text" title = "Mobile Number" value placeholder = "+91 Mobile Number" name="mobile_number" id="mobile_number_value" maxlength="25" class="mpps_input_full">
                </br>                
				<input type="text" title = "Birthday" value placeholder = "Birthday: " name="birthday" id="birthday" maxlength="25" class="mpps_input_label" disabled="disabled">
                <select class="mpps_input_select" name="dd" id="day">
	                   <option value="">Date</option>
                       <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8
                       </option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</
                       option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</
                       option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</
                       option><option value="30">30</option><option value="31">31</option>	                  
                 </select>
	             <select class="mpps_input_select" name="mm" id="month">
                 	<option value="">Month</option><option title="January" value="1">January</option><option title="February" value="2">February</option><option title="March" value="3">March</option><option title="April" value="4">
                        April</option><option title="May" value="5">May</option><option title="June" value="6">June</option><option title="July" value="7">July</option><option title="August" value="8">August</option><option title=
                        "September" value="9">September</option><option title="October" value="10">October</option><option title="November" value="11">November</option><option title="December" value="12">December</option>			                  </select>
                  <select class="mpps_input_select" name="yyyy" id="year">
                            <option value="">Year</option>
                            <option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option>
                            <option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option>
                            <option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option>
                            <option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option>
                            <option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option>
                            <option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
                            <option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option>
                            <option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option>
                            <option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option>
                            <option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option>
                            <option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option>
                            <option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option>
                            <option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option>
                            <option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option>
                            <option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option>
                            <option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option>
                            <option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option>
                            <option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option>
                            <option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option>
                            <option value="1901">1901</option><option value="1900">1900</option><option value="1899">1899</option><option value="1898">1898</option><option value="1897">1897</option><option value="1896">1896</option>
                            <option value="1895">1895</option><option value="1894">1894</option><option value="1893">1893</option><option value="1892">1892</option><option value="1891">1891</option><option value="1890">1890</option>
                            <option value="1889">1889</option><option value="1888">1888</option><option value="1887">1887</option><option value="1886">1886</option><option value="1885">1885</option>                          
                   </select>       
                </br>
				<div class="gender_class" role="radiogroup">
					<input type="radio" class='redio_input' id="male" name="gender" value="m">
                    <label for="male">Male</label>
					<input type="radio" class='redio_input' id="female" name="gender" value="f">
                    <label for="female">Female</label>
	              </div>
   				<input type="text" title = "Recovery E-mail Address" value placeholder = "Recovery E-mail Address" name="r_email" id="r_email_value" maxlength="25" class="mpps_input_full">
                </br></br>               
                <div id="create_button_div">
	        			<input id='create_button' class="btn_dblue ui-button ui-widget ui-state-default ui-corner-all" id="id_create_aro" type="button" value="Create MPPS Account" 
        	        	name="create" role="button" aria-disabled="false">
		        </div>
            </fieldset>	
        </form>
     </div>-->
     </div>
     <div id="admin_page_div"></div>
</div>
    
<!-- Header starts -->
<?php include_once("footer.php"); ?>
<!-- Header ends -->