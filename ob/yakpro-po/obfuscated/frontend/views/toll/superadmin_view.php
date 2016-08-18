<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto wmDaR; WgOhX: echo KsFh8("\164\157\x6c\x6c\x63\x65\156\x74\145\x72\x2f\x67\x65\164\x5f\x73\151\x6e\x67\x6c\x65\x5f\x63\x68\x61\x72\147\145\137\144\x65\x74\x61\151\154\163\137\x66\x6f\162\137\x76\151\145\x77"); goto mfrgZ; wWi1S: foreach ($O8clp as $V7w_c => $UoEr0) { goto VojbF; FOJXo: echo @$UoEr0->Nb6y_; goto xvw3t; ON2qM: Fl6__: goto ajEbW; IDGtg: ?>
</td>
    					<td><?php  goto L941Z; Izcjm: ?>
</td>
    					<td>
    						<button type="button"  onclick='edit_charger_details("<?php  goto S2NIJ; DQ3dS: echo @$UoEr0->gF1ME; goto IDGtg; fIk87: ?>
</td>
    					<td><?php  goto VQd7f; VojbF: ?>
    				<tr>
    					<td><?php  goto EQlTV; fkJyH: echo @$UoEr0->HzHN0; goto Izcjm; L941Z: echo @$UoEr0->ZoBQz; goto fIk87; xvw3t: ?>
</td>
    					<td><?php  goto tn8IT; VQd7f: echo @$UoEr0->fZ_YZ; goto IYHAr; tTyk9: ?>
</td>
    					<td><?php  goto FOJXo; S2NIJ: echo @$UoEr0->q9pm2; goto UvnbS; lkK54: ?>
</td>
    					<td><?php  goto DQ3dS; UvnbS: ?>
")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Charges</button>
    					</td>
    				</tr>
    			<?php  goto ON2qM; tn8IT: echo @$UoEr0->kgb2c . "\40" . $UoEr0->bOI2x; goto lkK54; EQlTV: echo @$UoEr0->HIkuN; goto tTyk9; ftbil: ?>
</td>
    					<td><?php  goto nEMs8; IYHAr: ?>
</td>
    					<td><?php  goto KVivS; nEMs8: echo @$UoEr0->xQR75; goto qpC0m; KVivS: echo @$UoEr0->D_pUB; goto ftbil; qpC0m: ?>
</td>
    					<td><?php  goto fkJyH; ajEbW: } goto jX8i1; wmDaR: ?>
<table class="table" style="width:90%; margin-left:5%; border: 1px #DDD solid;">
  <thead>
    <tr>
      <th>Toll Location</th>
      <th>Toll Name</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>A/C Number</th>
      <th>Bank Name</th>
      <th>Bank Address</th>
      <th>A/C Name</th>
      <th>View</th>
    </tr>
  </thead>
    <tbody>
    	<?php  goto YQEm8; jX8i1: hWzCq: goto xYDos; CLbat: ?>
    </tbody>
</table>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="pop_view" style="color:#000; font-weight:normal;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
      </div>
      
    </div>
  </div>
</div>

<script>
function edit_charger_details(id)
{
	if(id !='')
	{
	  $.ajax({
	    "url"  : "<?php  goto WgOhX; xYDos: z0CeB: goto CLbat; YQEm8: if (!(isset($O8clp) && !empty($O8clp))) { goto z0CeB; } goto wWi1S; mfrgZ: ?>
",
	    "type" : "POST",
	    "data" : ({'id':id}),
	    success:function(response){
	      console.log(response);
	       $("#pop_view").text("");
	     // var data = $.parseJSON(response);
	      //console.log(response);return false;
	      $("#pop_view").append(response);
	      
	    }
	  });
	}
}
</script>
