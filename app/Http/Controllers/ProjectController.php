<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use App\authorized_user;
use App\project;
use App\kavling;
use App\price;
use App\promo;
use App\official;
use App\kavling_type;
use App\strategic_type;
use App\siteplan;
use Datatables;

class ProjectController extends Controller
{
    public function getProject(){
    	$project= project::all();
        return view('page.project.project',compact('project'));
    }

    public function getProjectdata(){
    	$project = project::all();
    	return Datatables::of($project)
    		->addColumn('image',function($project){
    			return '<a href="project/siteplan/'.$project->id.'" class="btn thumbnail"><i class="fa fa-picture-o" aria-hidden="true" style="font-size:50px;color:black;"></i></a>';
    		})
            ->addColumn('action',function($project){
                return
                '<a href="project/edit/'.$project->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                 </a>
                 <a href="project/authorizeduser/'.$project->id.'" class="btn btn-xs btn-success"><i class="fa fa-users" aria-hidden="true"></i> Authorized user
                 </a>
                 <a href="project/'.$project->id.'/kavling" class="btn btn-xs btn-info"><i class="fa fa-home" aria-hidden="true"></i> Kavling
                 </a>
                 <a href="project/'.$project->id.'/pricelist" class="btn btn-xs btn-warning"><i class="fa fa-money" aria-hidden="true"></i> Price List
                 </a>
                 <a href="project/hapus/'.$project->id.'" class="btn btn-xs btn-danger" id="confirm">
                 <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                 </a>
                 ';
              })
            ->make(true);

    }

    public function getAddProject(){
    	return view('page.project.addproject');
    }

    public function postAddProject(Request $request){
    	$this->validate($request,[
					  'name'=>'required|min:3|unique:project,name',
						'company'=>'required|min:3|unique:project,company',
						'area'=>'required|numeric|min:0',
						'unit_total'=>'required|numeric|min:0',
						'location'=>'required',
    	]);
				       	$project = new project();
				        $project->name = $request->input('name');
				        $project->company = $request->input('company');
								$project->area = $request->input('area');
								$project->unit_total = $request->input('unit_total');
								$project->location = $request->input('location');
								$project->booking_free = $request->input('booking_free');
								$project->booking_comission = $request->input('booking_comission');
								$project->nup_free = $request->input('nup_free');
								$project->nup_comission = $request->input('nup_comission');
								$project->akad_comission = $request->input('akad_comission');

				$project->save();
				alert()->success('Data berhasil disimpan !');
				return redirect()->route('project.view');
    }

    public function getEditProject($id){
     	$edit = project::where('id',$id)->first();
    	return view('page.project.editproject',compact('edit'));
    }

    public function getHapusProject($id){
    	$authorizeduser = authorized_user::where('project_id',$id);
    	$kavling = kavling::where('project_id',$id);
    	$price = price::where('project_id',$id);
    	$project = project::find($id);
    					$authorizeduser->delete();
				    	$kavling->delete();
				    	$price->delete();
				    	$project->delete();
    	alert()->success('Data berhasil dihapus !')->autoclose(1500);
    	return redirect()->route('project.view');
    }

    public function postUpdateProject(Request $request,$id){
    	$this->validate($request,[
						'name' => 'required',
						'company'=> 'required',
						'area'=> 'required|numeric|min:0',
						'unit_total'=> 'required|numeric|min:0',
						'location'=> 'required',
						'booking_free'=> 'required|numeric|min:0',
						'booking_comission'=> 'required|numeric|min:0',
						'nup_free'=> 'required|numeric|min:0',
						'nup_comission'=> 'required|numeric|min:0',
						'akad_comission'=> 'required|numeric|min:0',
    	]);

      	$project = project::where('id',$id)->first();
      	$project->name = $request->input('name');
      	$project->company = $request->input('company');
				$project->area = $request->input('area');
				$project->unit_total = $request->input('unit_total');
				$project->location = $request->input('location');
				$project->booking_free = $request->input('booking_free');
				$project->booking_comission = $request->input('booking_comission');
				$project->nup_free = $request->input('nup_free');
				$project->nup_comission = $request->input('nup_comission');
				$project->akad_comission = $request->input('akad_comission');
				$project->update();

				alert()->success('Data berhasil diupdate !');
				return redirect()->route('project.view');
    }


    public function getAddKavling($id){
    	$project = project::where('id',$id)->first();
    	$kavling = count(kavling::where('project_id',$id)->get());
    	$s_kavling_type = kavling_type::all();
    	$s_strategic_type = strategic_type::all();
    	return view('page.project.addkavling',compact('s_kavling_type','s_strategic_type','project','kavling'));
    }

    public function getKavling($id){
    	$project= project::where('id','=',$id)->first();
        return view('page.project.kavling',compact('project'));
    }

    public function getKavlingdata($id){
    	$kavling = kavling::where('project_id','=',$id)->get();
    	return Datatables::of($kavling)
    		->addColumn('type',function($kavling){
    				return $kavling->kavling_type->type;
    			})
    		->addColumn('price',function($kavling){
    				$harga = $kavling->project->price->where('kavling_type_id','=',$kavling->kavling_type_id)->first();
    				if(count($harga) > 0){
	    				if($harga->management_confirm_status == "Received"){
	    					return "Rp ".number_format($harga->price,0,',','.').',-';
	    				}else{
	    					return "Rp ".number_format(0,0,',','.').',-';
	    				}
    				}else{
	    				return "Rp ".number_format(0,0,',','.').',-';
	    			}
    			})
            ->addColumn('action',function($kavling){
                return
                '<a href="kavling/edit/'.$kavling->id.'" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                 <a href="kavling/hapus/'.$kavling->id.'" class="btn btn-xs btn-danger" onclick="return confirm(\'Hapus kavling '. $kavling->number.' ?\')">
                 <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
                 ';
              })
            ->editColumn('status',function($kavling){
            		return "<span class='label label-primary'>$kavling->status</span>";
            	})
             ->editColumn('progress',function($kavling){
            		return "<span class='label label-success'>$kavling->progress</span>";
            	})
            ->make(true);

    }

    public function postAddKavling(Request $request,$id){
    	$project = project::where('id',$id)->first();
    	$this->validate($request,[
    		'number'=>'required|numeric|unique:kavling,number',
    		'strategic_type_id'=>'required',
    		'field_size'=>'required|numeric',
    		'bpn_size'=>'required|numeric',
    		'left_over_size'=>'required|numeric',
    		'Imb_parent_date'=>'date',
    		'Imb_fraction_date'=>'date'
    	]);

    	if(count(kavling::where('project_id',$id)->get()) >= $project->unit_total){

				return back()->with('error','Unit Kavling sudah penuh !');
			}else{

		    	$kavling = new kavling();
		    	$kavling->number = $request->input('number');
		    	$kavling->field_size = $request->input('field_size');
		    	$kavling->bpn_size = $request->input('bpn_size');
		    	$kavling->left_over_size = $request->input('left_over_size');
		    	$kavling->Imb_parent = $request->input('Imb_parent');
		    	$kavling->Imb_parent_date = $request->input('Imb_parent_date');
		    	$kavling->Imb_fraction = $request->input('Imb_fraction');
		    	$kavling->Imb_fraction_date = $request->input('Imb_fraction_date');
		    	$kavling->pbb = $request->input('pbb');
		    	$kavling->pln_no = $request->input('pln_no');
		    	$kavling->status = $request->input('status');
		    	$kavling->progress = $request->input('progress');
		    	$kavling->strategic_type_id = $request->input('strategic_type_id');
		    	$kavling->kavling_type_id = $request->input('kavling_type_id');
		    	$kavling->project_id = $id;
		    	$kavling->save();

					return back()->with('success','Data berhasil disimpan !');
			}
    }

    public function getEditKavling($id,$kav_id){
    	$s_kavling_type = kavling_type::all();
    	$s_strategic_type = strategic_type::all();
     	$edit = kavling::where('id','=',$kav_id,'and','project_id','=',$id)->first();
    	return view('page.project.editkavling',compact('edit','s_kavling_type','s_strategic_type'));
    }

    public function postUpdateKavling(Request $request,$id,$kav_id){
    	$this->validate($request,[
    		'number'=>'required|numeric',
    		'kavling_type_id'=>'required',
    		'strategic_type_id'=>'required',
    		'field_size'=>'required|numeric',
    		'bpn_size'=>'required|numeric',
    		'left_over_size'=>'required|numeric',
    		'Imb_parent_date'=>'date',
    		'Imb_fraction_date'=>'date'
    	]);

    	$kavling = kavling::where('id','=',$kav_id,'and','project_id','=',$id)->first();
    	$kavling->number = $request->input('number');
    	$kavling->field_size = $request->input('field_size');
    	$kavling->bpn_size = $request->input('bpn_size');
    	$kavling->left_over_size = $request->input('left_over_size');
    	$kavling->Imb_parent = $request->input('Imb_parent');
    	$kavling->Imb_parent_date = $request->input('Imb_parent_date');
    	$kavling->Imb_fraction = $request->input('Imb_fraction');
    	$kavling->Imb_fraction_date = $request->input('Imb_fraction_date');
    	$kavling->pbb = $request->input('pbb');
    	$kavling->pln_no = $request->input('pln_no');
    	$kavling->status = $request->input('status');
    	$kavling->progress = $request->input('progress');
    	$kavling->strategic_type_id = $request->input('strategic_type_id');
    	$kavling->kavling_type_id = $request->input('kavling_type_id');
    	$kavling->project_id = $id;
    	$kavling->update();
    	alert()->success('Data telah diperbaharui !')->autoclose(1500);
			return redirect()->route('kavling.view',$id);
	}

    public function getHapusKavling($id,$kav_id){
    	$kavling = kavling::where('id','=',$kav_id,'and','project_id','=',$id)->first();
    	$kavling->delete();
    	alert()->success('Data berhasil dihapus !')->autoclose(1500);
    	return redirect()->route('kavling.view',$id);
    }

    // Pricelist
    public function getPricelist($id){
    	$project= project::where('id','=',$id)->first();
       return view('page.project.pricelist',compact('project'));
    }

    public function getAddPricelist($id){
    	$project = project::where('id',$id)->first();
    	$s_kavling_type = kavling_type::all();
    	$s_strategic_type = strategic_type::all();
    	return view('page.project.addpricelist',compact('s_kavling_type','s_strategic_type','project'));
    }

    public function postAddPricelist(Request $request,$id){
    	$code_id = price::where('project_id','=',$id)->get();
    	$input = $request->all();
    	$rules = [
    		'kavling_type_id'		=> 'required',
    		'expired_date'			=> 'required|date',
    		'price'							=> 'required|numeric|min:0',
    		'administration_price'=> 'required|numeric|min:0',
    		'renovation_price'	=> 'required|numeric|min:0',
    		'left_over_price'		=> 'required|numeric|min:0',
    		'move_kavling_price'=> 'required|numeric|min:0',
    		'change_name_price'	=> 'required|numeric|min:0',
    		'status'						=> 'required',
    	];
  		$message = [
  									'kavling_type_id.required'			=> 'The Field: Kavling Type must choose one',
						    		'expired_date.required'					=> 'The Field: Expired Date is required',
						    		'expired_date.date'							=> 'The Field: Expired Date must format date',
						    		'price.required'								=> 'The Field: Price Type is required',
						    		'price.numeric'									=> 'The Field: Price must format number',
						    		'administration_price.required' => 'The Field: Administration Price Type is required',
						    		'administration_price.numeric'	=> 'The Field: Administration Price must format number',
						    		'renovation_price.required'			=> 'The Field: Renovation Price Type is required',
						    		'renovation_price.numeric'			=> 'The Field: Renovation Price must format number',
						    		'left_over_price.required'			=> 'The Field: Left Over Price Type is required',
						    		'left_over_price.numeric'				=> 'The Field: Left Over Price must format number',
						    		'move_kavling_price.required'		=> 'The Field: Move Kavling Price Type is required',
						    		'move_kavling_price.numeric'		=> 'The Field: Move Kavling Price must format number',
						    		'change_name_price.required'		=> 'The Field: Change Name Price Type is required',
						    		'change_name_price.numeric'			=> 'The Field: Change Name Price must format number',
						    		'status.required'								=> 'The Field: Status Type is required'
  		];

  		$validator = Validator::make($input,$rules,$message);

  		if($validator->passes()){

  				if( count($code_id->where('kavling_type_id',$request->input('kavling_type_id'))->first()) <= 0 ){

				    	$price = new price();
				    	$price->kavling_type_id 					= $request->input('kavling_type_id');
				    	$price->expired_date		 					= $request->input('expired_date');
				    	$price->price 										= $request->input('price');
				    	$price->administration_price 			= $request->input('administration_price');
				    	$price->renovation_price 					= $request->input('renovation_price');
				    	$price->left_over_price 					= $request->input('left_over_price');
				    	$price->move_kavling_price 				= $request->input('move_kavling_price');
				    	$price->change_name_price 				= $request->input('change_name_price');
				    	$price->management_confirm_status = $request->input('status');
				    	$price->memo 											= $request->input('memo');
				    	$price->project_id 								= $id;
				    	$price->save();

				    	alert()->success('Data berhasil disimpan !')->autoclose(1500);
							return redirect()->route('pricelist.view',$id);
					}else{
							return redirect()->route('pricelist.add',$id)->with('PesanError','Data yang Anda isi sudah ada !');
					}

			}else{
						return redirect()->route('pricelist.add',$id)->withErrors($validator)->withInput();
			}

    }

    public function getEditPricelist($id,$price_id){
    	$s_kavling_type = kavling_type::all();
     	$edit = price::where('id','=',$price_id,'and','project_id','=',$id)->first();
    	return view('page.project.editpricelist',compact('edit','s_kavling_type'));
    }

    public function postUpdatePricelist(Request $request,$id,$price_id){
    	$this->validate($request,[
    		'kavling_type_id'=>'required',
    		'expired_date'=>'required|date',
    		'price'=>'required|numeric|min:0',
    		'administration_price'=>'required|numeric|min:0',
    		'renovation_price'=>'required|numeric|min:0',
    		'left_over_price'=>'required|numeric|min:0',
    		'move_kavling_price'=>'required|numeric|min:0',
    		'change_name_price'=>'required|numeric|min:0',
    		'status'=>'required',
    	]);

    	$price = price::where('id','=',$price_id,'and','project_id','=',$id)->first();
    	$price->kavling_type_id = $request->input('kavling_type_id');
    	$price->expired_date = $request->input('expired_date');
    	$price->price = $request->input('price');
    	$price->administration_price = $request->input('administration_price');
    	$price->renovation_price = $request->input('renovation_price');
    	$price->left_over_price = $request->input('left_over_price');
    	$price->move_kavling_price = $request->input('move_kavling_price');
    	$price->change_name_price = $request->input('change_name_price');
    	$price->management_confirm_status = $request->input('status');
    	$price->memo = $request->input('memo');
    	$price->project_id = $id;
    	$price->update();
    	alert()->success('Data berhasil diperbaharui !');

			return redirect()->route('pricelist.view',$id);
	}

	public function getHapusPricelist($id,$price_id){
    	$price = price::where('id','=',$price_id,'and','project_id','=',$id)->first();
    	$price->delete();
    	alert()->success('Data berhasil dihapus !')->autoclose(1500);

    	return redirect()->route('pricelist.view',$id);
  }

   // Siteplan
    public function getSiteplan($id){
    	$project= project::where('id','=',$id)->first();
        return view('page.project.siteplan',compact('project'));
    }
    public function getAddSiteplan($id){
    	$project = project::where('id',$id)->first();
    	$s_kavling_type = kavling_type::all();
    	$s_strategic_type = strategic_type::all();
    	return view('page.project.addsiteplan',compact('s_kavling_type','s_strategic_type','project'));
    }

    public function postAddSiteplan(Request $request,$id){
    			$siteplan = new siteplan();
					    	$file = $request->file('file');
					    	$filename = time().'.'.$file->getClientOriginalName();
					    	$path = public_path('image/'.$filename);
					    	Image::make($file->getRealPath())->resize(600,600)->save($path);

					  $siteplan->image = $filename;
					  $siteplan->project_id = $id;
					  $siteplan->save();
    }

     public function getEditSiteplan($id,$siteplan_id){
     	$edit = siteplan::where('id','=',$siteplan_id,'and','project_id','=',$id)->first();
    	return view('page.project.editsiteplan',compact('edit'));
    }

    public function postUpdateSiteplan(Request $request,$id,$siteplan_id){
    	$this->validate($request,[
    		'file'=>'image|mimes:jpeg,png,jpg'
    	]);
    	$update = siteplan::where('id','=',$siteplan_id,'and','project_id','=',$id)->first();
    	if(empty(Input::file('file'))){
    		$update->image = $update->image;
    		alert()->error('Update foto gagal !');
    	}else{
	    	$image = Input::file('file');
	        $namafile = time().'.'.$image->getClientOriginalExtension();
	        $path = public_path('image/'.$namafile);
	        Image::make($image->getRealPath())->resize(600,600)->save($path);

	        $update->image = $namafile;
	        alert()->success('Update foto berhasil !')->autoclose(1500);
    	}
    	$update->update();
    	return redirect()->route('siteplan.view',$id);

    }

    public function getHapusSiteplan($id,$siteplan_id){
    	$siteplan = siteplan::where('id','=',$siteplan_id,'and','project_id','=',$id)->first();
    	$siteplan->delete();
    	alert()->success('Data berhasil dihapus !')->autoclose(1500);
    	return redirect()->route('siteplan.view',$id);
    }

    public function getDropSiteplan($id){
    	$siteplan = siteplan::where('project_id','=',$id);
    	$siteplan->delete();
    	alert()->success('Data berhasil dihapus !')->autoclose(1500);
    	return redirect()->route('siteplan.view',$id);
    }

    // Authorized Users
    public function getAuthorizeduser($id){
    	$data = project::where('id',$id)->first();
    	return view('page.project.authorizeduser',compact('data'));
    }

    public function getAddAuthorizeduser($id){
    	$data = project::where('id',$id)->first();
    	$project_manager = official::where('role','=','Project Manager')
    			->where('status','=','Active')->pluck('name');

    	$project_manager_assistant = official::where('role','=','Project Manager Assistant')
    			->where('status','=','Active')->pluck('name');

    	$staff_finance = official::where('role','=','Staff Finance')
    			->where('status','=','Active')->pluck('name');

    	$staff_inhouse = official::where('role','=','Staff Inhouse')
    			->where('status','=','Active')->pluck('name');

    	$field_executive = official::where('role','=','Field Executive')
    			->where('status','=','Active')->pluck('name');

    	$admin = official::where('role','=','Admin')
    			->where('status','=','Active')->pluck('name');

    	return view('page.project.addauthorizeduser',compact('data','project_manager','project_manager_assistant','staff_finance','staff_inhouse','field_executive','admin'));
    }

    public function postAddAuthorizeduser(Request $request,$id){
    	$input = Input::all();
    	$rules = [
    						'project_manager' => 'required',
    						'project_manager_assistant' => 'required',
    						'finance_spv' => 'required',
    						'inhouse_spv' => 'required',
    						'field_executive' => 'required',
    						'admin' => 'required',
    						'legal' => 'required'
    	];
    	$message = [

				'project_manager.required'	=> 'The Field: Project Manager is required',
				'project_manager_assistant.required'	=> 'The Field: Project Manager Assistant is required',
				'finance_spv.required'	=> 'The Field: Finance SPV is required',
				'inhouse_spv.required'	=> 'The Field: inhouse SPV is required',
				'field_executive.required'	=> 'The Field: Field Executive is required',
				'admin.required'	=> 'The Field: Admin is required',
				'legal.required'	=> 'The Field: Legal is required'

    	];

    				$validator = validator::make($input,$rules,$message);

    				if($validator->passes()){

    							$authorizeduser = new authorized_user();
    							$authorizeduser->project_manager 					 = Input::get('project_manager');
    							$authorizeduser->project_manager_assistant = Input::get('project_manager_assistant');
    							$authorizeduser->finance_spv 							 = Input::get('finance_spv');
    							$authorizeduser->inhouse_spv 							 = Input::get('inhouse_spv');
    							$authorizeduser->field_executive					 = Input::get('field_executive');
    							$authorizeduser->admin 										 = Input::get('admin');
    							$authorizeduser->legal 										 = Input::get('legal');
    							$authorizeduser->project_id 							 = $id;
    							$authorizeduser->save();

    							alert()->success('Data berhasil disimpan !');
    							return redirect()->route('authorizeduser.view',$id);
    				}else{
    							return redirect()->route('authorizeduser.add',$id)->withErrors($validator)->withInput();
    				}

    }

    public function getEditAuthorizeduser($id,$authorized_id){
    	$edit = authorized_user::where('project_id',$id)->where('id',$authorized_id)->first();
    	$project_manager = official::where('role','=','Project Manager')
    			->where('status','=','Active')->pluck('name');

    	$project_manager_assistant = official::where('role','=','Project Manager Assistant')
    			->where('status','=','Active')->pluck('name');

    	$staff_finance = official::where('role','=','Staff Finance')
    			->where('status','=','Active')->pluck('name');

    	$staff_inhouse = official::where('role','=','Staff Inhouse')
    			->where('status','=','Active')->pluck('name');

    	$field_executive = official::where('role','=','Field Executive')
    			->where('status','=','Active')->pluck('name');

    	$admin = official::where('role','=','Admin')
    			->where('status','=','Active')->pluck('name');
    	return view('page.project.editauthorizeduser',compact('edit','project_manager','project_manager_assistant','staff_finance','staff_inhouse','field_executive','admin'));
    }

    public function postUpdateAuthorizeduser(Request $request,$id,$authorized_id){
    	$input = Input::all();
    	$rules = [
    						'project_manager' => 'required',
    						'project_manager_assistant' => 'required',
    						'finance_spv' => 'required',
    						'inhouse_spv' => 'required',
    						'field_executive' => 'required',
    						'admin' => 'required',
    						'legal' => 'required'
    	];
    	$message = [

				'project_manager.required'	=> 'The Field: Project Manager is required',
				'project_manager_assistant.required'	=> 'The Field: Project Manager Assistant is required',
				'finance_spv.required'	=> 'The Field: Finance SPV is required',
				'inhouse_spv.required'	=> 'The Field: inhouse SPV is required',
				'field_executive.required'	=> 'The Field: Field Executive is required',
				'admin.required'	=> 'The Field: Admin is required',
				'legal.required'	=> 'The Field: Legal is required'

    	];

    				$validator = validator::make($input,$rules,$message);

    				if($validator->passes()){

    							$authorizeduser = authorized_user::where('id',$authorized_id)->first();
    							$authorizeduser->project_manager 					 = Input::get('project_manager');
    							$authorizeduser->project_manager_assistant = Input::get('project_manager_assistant');
    							$authorizeduser->finance_spv 							 = Input::get('finance_spv');
    							$authorizeduser->inhouse_spv 							 = Input::get('inhouse_spv');
    							$authorizeduser->field_executive					 = Input::get('field_executive');
    							$authorizeduser->admin 										 = Input::get('admin');
    							$authorizeduser->legal 										 = Input::get('legal');
    							$authorizeduser->update();

    							alert()->success('Data berhasil diupdate !');
    							return redirect()->route('authorizeduser.view',$id);
    				}else{
    							return redirect()->route('authorizeduser.edit',$id)->withErrors($validator)->withInput();
    				}

    }

    public function getHapusAuthorizeduser(){

    }

    // users
    public function getOfficial(){
    	return view('page.project.official');
    }

    public function getOfficialdata(){
    	$official = official::all();
    	return Datatables::of($official)
    			->addColumn('action',function($official){
    				return
                '<a href="users/edit/'.$official->id.'" class="btn btn-xs btn-warning">
                	<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                 </a>
                 <a href="users/hapus/'.$official->id.'" class="btn btn-xs btn-danger" id="confirm">
                 	<i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                 </a>
                 ';
    			})
    			->editColumn('status',function($official){
    					if($official->status == "Active"){

    						return "<span class='label label-primary'>$official->status</span>";
    					}else{
    						return "<span class='label label-danger'>$official->status</span>";

    					}
    			})
    			->make(true);
    }

    public function getAddOfficial(){
    	return view('page.project.addofficial');
    }

    public function postAddOfficial(Request $request){
    	$input = Input::all();
    	$rules = [
    							'name' => 'required|min:5|unique:official,name',
    							'email' => 'required|email',
    							'status' => 'required',
    							'role' => 'required'
    	];
    	$message = [
    		'name.required' 	=> 'The Field: Name is Required',
    		'email.required' 	=> 'The Field: Email is Required',
    		'email.email' 		=> 'The Field: Must format Email',
    		'status.required' => 'The Field: Status is Required',
    		'role.required' 	=> 'The Field: Role is Required',
    	];

    			$validator = Validator::make($input,$rules,$message);

    			if($validator->passes()){

    					$official = new official();
    					$official->name   = Input::get('name');
    					$official->email  = Input::get('email');
    					$official->status = Input::get('status');
    					$official->role   = Input::get('role');
    					$official->save();

    					return redirect()->route('official.add')->with('success','Data berhasil disimpan !');
    			}else{

    					return redirect()->route('official.add')->withErrors($validator)->withInput();
    			}
    }

    public function getEditOfficial($id){
    	$edit = official::where('id',$id)->first();
    	return view('page.project.editofficial',['edit' => $edit]);
    }

    public function postUpdateOfficial(Request $request,$id){
    	$input = Input::all();
    	$rules = [
    							'name' => 'required|min:5',
    							'email' => 'required|email',
    							'status' => 'required',
    							'role' => 'required'
    	];
    	$message = [
    		'name.required' 	=> 'The Field: Name is Required',
    		'email.required' 	=> 'The Field: Email is Required',
    		'email.email' 		=> 'The Field: Must format Email',
    		'status.required' => 'The Field: Status is Required',
    		'role.required' 	=> 'The Field: Role is Required',
    	];

    			$validator = Validator::make($input,$rules,$message);

    			if($validator->passes()){

    					$official = official::where('id',$id)->first();
    					$official->name   = Input::get('name');
    					$official->email  = Input::get('email');
    					$official->status = Input::get('status');
    					$official->role   = Input::get('role');
    					$official->update();

    					alert()->success('Data berhasil diupdate !')->autoclose(1500);
    					return redirect()->route('official.view');
    			}else{

    					return redirect()->route('official.edit',$id)->withErrors($validator)->withInput();
    			}
    }

    public function getHapusOfficial($id){
    	$official = official::where('id',$id)->first();
    	$official->delete();
    	alert()->success('Data berhasil dihapus !')->autoclose(1500);
    	return redirect()->route('official.view');

    }

    // Promo
    public function getPromo(){
    	return view('page.project.promo');
    }

    public function getPromodata(){
    	$promo = promo::all();
    	return Datatables::of($promo)
    			->addColumn('action',function($promo){
    				return
    				'<a href="promo/edit/'.$promo->id.'" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
    				 <a href="promo/hapus/'.$promo->id.'" class="btn btn-xs btn-danger" onclick="return confirm(\'Hapus '.$promo->name.' ? \')">
    				 	<i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
    				 </a>';
    			})
    			->editColumn('discount',function( $promo){
    				return $promo->discount."%";
    			})
    			->make(true);

    }

    public function getAddPromo(){
    	return view('page.project.addpromo');
    }

    public function postAddPromo(Request $request){
    	$this->validate($request,[
    		'name'=>'required|unique:promo,name',
    		'date_start'=>'required|date',
    		'date_end'=>'required|date',
    		'discount'=>'required|numeric|min:0',
    		'agent_bonus'=>'required|numeric|min:0',
    		'team_bonus'=>'required|numeric|min:0'
    	]);
  	$promo = new promo();
  	$promo->name = $request->input('name');
		$promo->date_start = $request->input('date_start');
		$promo->date_end = $request->input('date_end');
		$promo->discount = $request->input('discount');
		$promo->agent_bonus = $request->input('agent_bonus');
		$promo->team_bonus = $request->input('team_bonus');
		$promo->save();
		return redirect()->route('promo.add')->with('success','Data berhasil disimpan !');
    }

    public function getEditPromo($id){
    	$edit = promo::where('id',$id)->first();
    	return view('page.project.editpromo',['edit' => $edit]);
    }

    public function postUpdatePromo(Request $request,$id){
    	$this->validate($request,[
    		'name' => 'required',
				'date_start' => 'required|date',
				'date_end' => 'required|date',
				'discount' => 'required|numeric|min:0',
				'agent_bonus' => 'required|numeric|min:0',
	 			'team_bonus' => 'required|numeric|min:0',
    	]);

    $promo = promo::where('id',$id)->first();
		$promo->name = $request->input('name');
		$promo->date_start = $request->input('date_start');
		$promo->date_end = $request->input('date_end');
		$promo->discount = $request->input('discount');
		$promo->agent_bonus = $request->input('agent_bonus');
		$promo->team_bonus = $request->input('team_bonus');
		$promo->update();
		alert()->success('Data berhasil diperbaharui !')->autoclose(1500);
		return redirect()->route('promo.view');
    }

    public function getHapusPromo($id){
    	$promo = promo::where('id',$id)->first();
    	$promo->delete();
    	alert()->success('Data berhasil dihapus !')->autoclose(1500);
    	return redirect()->route('promo.view');
    }


}
