<div id="bandeau">
<div id="searche">
<script type="text/javascript">

function Gsitesearch(curobj){
var domainroot=curobj.domainroot[curobj.domainroot.selectedIndex].value
curobj.q.value="site:"+domainroot+" "+curobj.qfront.value
}

</script>

<form action="http://www.google.com/search" method="get" onSubmit="Gsitesearch(this)">


<input name="q" type="hidden" />
<input name="qfront" value="Recherche Google" onfocus="this.value='';" title="Saisissez les mots-cles à rechercher" type="text" size="20" />
&nbsp;dans&nbsp;: 
<select name="domainroot">
<option value="www.randonner-leger.org/forum/" selected="1">le Forum</option>
<option value="www.randonner-leger.org/wiki/">le Wiki</option>
<option value="www.randonner-leger.org">tout le site</option>
</select>


</form>
</div>
</div>
<div class="clar"></div>