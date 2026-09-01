<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{

    ///////////  Start Ship Division Functions /////////////////


    // View Ship Division Page
    public function divisionView()
    {
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        return view('backend.ship.division.view_division',compact('divisions'));
    } // End Method


    // division store
    public function divisionstore(request $request)
    {
        $request->validate([
            'division_name' => 'required',
        ], [
            'division_name.required' => 'Please enter division name',
        ]);


        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Division added successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);

    } // End Method


    // Division edit page
    public function divisionEdit($id)
    {
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division',compact('division'));
    } // End Method


    // Division update
    public function divisionUpdate(Request $request,$id)
    {
        $request->validate([
            'division_name' => 'required',
        ], [
            'division_name.required' => 'Please enter division name',
        ]);


        ShipDivision::findOrfail($id)->update([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => 'Division updated successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('manage.division')->with($notification);
    } // End Method



    // Delete Dicision
    public function divisionDelete($id)
    {
        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);

    } // End method



    ///////////  Start Ship District Functions /////////////////


    // view district page
    public function districtView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('divisions', 'districts'));
    }

    // Add ship district
    public function districtstore(request $request)
    {
        $request->validate([
            'division_id' => 'required',
    		'district_name' => 'required',
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District added successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);

    } // End Method



    // Edit ship district
    public function districtEdit($id)
    {
        $district = ShipDistrict::findOrFail($id);
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.district.edit_district',compact('district', 'divisions'));
    } // End Method


    // Update ship District
    public function districtUpdate(Request $request,$id)
    {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ]);

        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => 'District Updated successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('manage.district')->with($notification);

    } // End Method

    // District Delete
    public function districtDelete($id)
    {
        ShipDistrict::findOrFail($id)->delete($id);

        $notification = array(
            'message' => 'District deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    ///////////  Start Ship State Functions /////////////////

    // view ship state page
    public function stateView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $state = ShipState::with('division','district')->orderBy('id', 'DESC')->get();
        return view('backend.ship.state.view_state', compact('divisions', 'state'));
    }  // END Method


    // Sore state
    public function statestore(request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ]);

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'State added successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);

    } // End Methods


    // Edit Ship State page
    public function stateEdit($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state',compact('divisions', 'districts' ,'state'));
    }  // End Method


    // Update Ship State
    public function stateUpdate(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ]);


        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name
        ]);

        $notification = array(
            'message' => 'State updated successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('manage.state')->with($notification);

    } // End Method


    // Delete Ship State
    public function stateDelete($id)
    {
        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'State deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }




    // Fetch  Ship district for a specific ship division
    public function getDistrict($division_id)
    {
        $districts = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($districts);
    }  // END Method





}
