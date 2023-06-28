<?php
   use yii\helpers\Html;
   use yii\helpers\Url;
   use yii\helpers\HtmlPurifier;
   use yii2assets\printthis\PrintThis;   
?> 
<?php
echo PrintThis::widget([
	'htmlOptions' => [
		'id' => 'PrintThis',
		'btnClass' => 'btn btn-info',
		'btnId' => 'btnPrintThis',
		'btnText' => 'Print Report',
		'btnIcon' => 'fa fa-print'
	],
	'options' => [
		'debug' => false,
		'importCSS' => true,
		'importStyle' => false,
		'loadCSS' => Url::base().'css/print.css',
		'pageTitle' => "Healthcare Personnel (HCP) Categories",
		'removeInline' => false,
		'printDelay' => 333,
		'header' => null,
		'formValues' => true,
	]
]);
?>

<style media="screen">

table {
    margin: 0 auto;
    border-collapse: collapse;
    border-style: hidden;
    /*Remove all the outside
    borders of the existing table*/
}
table td {
    padding: 0.5rem;
    border: 1px solid blue;
}
table th {
    padding: 0.5rem;
    border: 1px solid orange;
}
</style>

<div id="PrintThis" class="page">
<table width="150%" class="center" >

   <th bgcolor="lightblue"><td colspan="7" align="center" bgcolor="orange"><h4>Healthcare Personnel (HCP) Categories</h4></td></th>


   <tr>
      <td></td><td><span style="color: red">*</span>All Core HCP<sup>a</sup></td><td><span style="color: red">*</span>All HCP<sup>b</sup></td><td><span style="color: red">*</span>Employees (staff on facility payroll)<sup>c</sup></td><td><span style="color: red">*</span>Licensed independent practitioners: Physicians, advanced practice nurses, & physician assistants <sup>d</sup> </td><td><span style="color: red">*</span>Adult students trainees and voluteers<sup>e</sup></td><td>*Other Contract Personnel<sup>f</sup></td>
   </tr>
   <tr>
      <td>1. <span style="color: red">*</span>Number of HCP that were eligible to have worked at this healthcare faiclity for at least 1 day turing the week of data collection</td><td align="center"><?=
$allstaff = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('status="Active"')
->count();
?></td><td align="center"><?= $allstaff; ?></td><td align="center"><?=
$employees = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$medstaff = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('status="Active" and (category="Physician" or category="Nurse" or category="PA")')
->count();
?></td><td align="center"><?=

$students = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('status="Active" and (category="Student" or category="Volunteer")')
->count()+$rows = (new \yii\db\Query())
->select(['sum(completed+partial+medical_exemption+religious_exemption+unknown)'])
->from('students')
->where(['id' => $maxid = (new \yii\db\Query())
->select(['*'])
->from('students')->max('id') ])
->limit(1)
->scalar()
;

?></td><td align="center"><?=
$contractors = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('category="Contractor" and status="Active"')
->count();
?></td>
   </tr>
   <tr>
      <td></td><td><span style="color: red">*</span>All Core HCP<sup>a</sup></td><td><span style="color: red">*</span>All HCP<sup>b</sup></td><td><span style="color: red">*</span>Employees (staff on facility payroll)<sup>c</sup></td><td><span style="color: red">*</span>Licensed independent practitioners: Physicians, advanced practice nurses, & physician assistants <sup>d</sup> </td><td><span style="color: red">*</span>Adult students trainees and voluteers<sup>e</sup></td><td>*Other Contract Personnel<sup>f</sup></td></tr>
   
   <tr>
      <td>2. <span style="color: red">*</span>Cumulative number of HTCP in Question #1 who have received primary series COVID-19 vaccines at this faiclity or elsewhere since Dcember 2020:</td><td align="center"><?=
$setcompleteemployee = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes"')
->count();
?></td><td align="center"><?= $setcompleteemployee; ?></td><td align="center"><?=
$employeesetcomplete = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$setcompleteproviders = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (category="Physician" or category="Nurse" or category="PA") and status="Active"')
->count(); ?></td><td align="center"><?=
$setcompletestudent = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and category="Student" and status="Active"')
->count()+$rows = (new \yii\db\Query())
->select(['sum(completed)'])
->from('students')
->where(['id' => $maxid = (new \yii\db\Query())
->select(['*'])
->from('students')->max('id') ])
->limit(1)
->scalar();
?></td><td align="center"><?=
$setcompletecontractor = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and category="Contractor" and status="Active"')
->count();
?></td><td></td>
   </tr>
   <tr>
      <td>2.1<span style="color: red">*</span>Only 1 dose of a two-dose Primary COVID-19 vaccine series</td><td align="center"><?=
$allstaffonedose = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity not like "Declination%" and medical_activity != "Unknown" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedose; ?></td><td align="center"><?=
$allstaffonedoseemployees = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity not like "Declination%" and medical_activity != "Unknown" and category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseproviders = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity not like "Declination%" and medical_activity != "Unknown" and (category="Physician" or category="Nurse" or category="PA") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedosestudents = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity not like "Declination%" and medical_activity != "Unknown" and (category="Student") and status="Active"')
->count()+$rows = (new \yii\db\Query())
->select(['sum(partial)'])
->from('students')
->where(['id' => $maxid = (new \yii\db\Query())
->select(['*'])
->from('students')->max('id') ])
->limit(1)
->scalar();
?></td><td align="center"><?=
$allstaffonedosecontractor = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity not like "Declination%" and medical_activity != "Unknown" and (category="Contractor") and status="Active"')
->count();
?></td>
   </tr>
   <tr>
      <td>2.2 <span style="color: red">*</span>Any completed Primary COVID-19 vaccine series</td><td align="center"><?=$setcompleteemployee;?></td><td align="center"><?=$setcompleteemployee;?></td><td align="center"><?= $employeesetcomplete; ?></td><td align="center"><?= $setcompleteproviders; ?></td><td align="center"><?= $setcompletestudent+$rows = (new \yii\db\Query())
->select(['sum(completed)'])
->from('students')
->where(['id' => $maxid = (new \yii\db\Query())
->select(['*'])
->from('students')->max('id') ])
->limit(1)
->scalar(); ?></td><td align="center"><?= $setcompletecontractor; ?></td>
   </tr>
   <tr>
      <td></td><td><span style="color: red">*</span>All Core HCP<sup>a</sup></td><td><span style="color: red">*</span>All HCP<sup>b</sup></td><td><span style="color: red">*</span>Employees (staff on facility payroll)<sup>c</sup></td><td><span style="color: red">*</span>Licensed independent practitioners: Physicians, advanced practive nurses, & physician assistants <sup>d</sup> </td><td><span style="color: red">*</span>Adult students trainees and voluteers<sup>e</sup></td><td>*Other Contract Personnel<sup>f</sup></td></tr> 
   <tr>
      <td colspan="7">3. <span style="color: red">*</span>Cumulative number of HCP in Question #1 with other conditions:</td>
   </tr>
   <tr>
      <td>3.1<span style="color: red">*</span>Medical contraindiction to COVID-19 vaccine</td><td align="center"><?=
$allstaffdeclinemedcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Medical Contraindiction" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffdeclinemedcont;
?></td><td align="center"><?=
$allstaffdeclineempmedcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Medical Contraindiction" and category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffdeclinephymedcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Medical Contraindiction" and (category="Physician" or category="Nurse" or category="PA") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedosestudentsmedcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Medical Contraindiction" and (category="Student") and status="Active"')
->count()+$rows = (new \yii\db\Query())
->select(['sum(medical_exemption)'])
->from('students')
->where(['id' => $maxid = (new \yii\db\Query())
->select(['*'])
->from('students')->max('id') ])
->limit(1)
->scalar();
?></td><td align="center"><?=
$allstaffonedosecontractormedcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Medical Contraindiction" and (category="Contractor") and status="Active"')
->count();
?></td>
   </tr>
   <tr>
      <td>3.2<span style="color: red">*</span>Offered but delcined COVID-19 vaccine</td><td align="center"><?=
$allstaffdecline = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity like "Declination%" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffdecline;
?></td><td align="center"><?=
$allstaffdeclineemp = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity like "Declination%" and category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffdeclinephy = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity  like "Declination%" and (category="Physician" or category="Nurse" or category="PA") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffdeclinestud = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity like "Declination%" and (category="Student") and status="Active"')
->count()+$rows = (new \yii\db\Query())
->select(['sum(medical_exemption+religious_exemption+unknown)'])
->from('students')
->where(['id' => $maxid = (new \yii\db\Query())
->select(['*'])
->from('students')->max('id') ])
->limit(1)
->scalar();
?></td><td align="center"><?=
$allstaffdeclinecontractor = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity like "Declination%" and (category="Contractor") and status="Active"')
->count();
?></td>
   </tr>
   <tr>
      <td>3.3<span style="color: red">*</span>Unknown COVID-19 vaccine status</td><td align="center"><?=
$allstaffonedoseunk = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Unknown" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunk;
?></td><td align="center"><?=
$allstaffonedoseunk = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Unknown" and category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkphy = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Unknown" and (category="Physician" or category="Nurse" or category="PA") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkstud= (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Unknown" and (category="Student") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="No" and medical_activity = "Unknown" and (category="Contractor") and status="Active"')
->count();
?></td>
</tr>
<tr>
      <td></td><td><span style="color: red">*</span>All Core HCP<sup>a</sup></td><td><span style="color: red">*</span>All HCP<sup>b</sup></td><td><span style="color: red">*</span>Employees (staff on facility payroll)<sup>c</sup></td><td><span style="color: red">*</span>Licensed independent practitioners: Physicians, advanced practive nurses, & physician assistants <sup>d</sup> </td><td><span style="color: red">*</span>Adult students trainees and voluteers<sup>e</sup></td><td>*Other Contract Personnel<sup>f</sup></td></tr> 
</tr>
<tr>
      <td>4<span style="color: red">*</span><u>Cumulative</u> number of HCP with complete primary series vaccine in Question #2 who have received any booster(s) or additional does(s) of COVID-19 vaccine since August 2021</td><td align="center"><?=
$allstaffonedoseunk = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted" or medical_activity="Boosted-1") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunk;
?></td><td align="center"><?=
$allstaffonedoseunk = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted" or medical_activity="Boosted-1") and category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkphy = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted" or medical_activity="Boosted-1") and (category="Physician" or category="Nurse" or category="PA") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkstud= (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted" or medical_activity="Boosted-1") and (category="Student") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted" or medical_activity="Boosted-1") and (category="Contractor") and status="Active"')
->count();
?></td>
</tr>
<tr>
      <td></td><td><span style="color: red">*</span>All Core HCP<sup>a</sup></td><td><span style="color: red">*</span>All HCP<sup>b</sup></td><td><span style="color: red">*</span>Employees (staff on facility payroll)<sup>c</sup></td><td><span style="color: red">*</span>Licensed independent practitioners: Physicians, advanced practive nurses, & physician assistants <sup>d</sup> </td><td><span style="color: red">*</span>Adult students trainees and voluteers<sup>e</sup></td><td>*Other Contract Personnel<sup>f</sup></td></tr> 
   <tr>
<tr>
<tr>
      <td>5<span style="color: red">*</span><u>Cumulative</u> number of HCP who are <u>up to date</u> with COVID-19 vaccines</td><td align="center"><?=
$allstaffonedoseunk = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunk;
?></td><td align="center"><?=
$allstaffonedoseunk = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted") and category="Employee" and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkphy = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted") and (category="Physician" or category="Nurse" or category="PA") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkstud= (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted") and (category="Student") and status="Active"')
->count();
?></td><td align="center"><?=
$allstaffonedoseunkcont = (new \yii\db\Query())

->select(['*'])

->from('stats')
->where('set_complete="Yes" and (medical_activity = "Boosted") and (category="Contractor") and status="Active"')
->count();
?></td>

</tr>
</table>
</div>
