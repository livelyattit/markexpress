<div class="pb-4 pr-4 pl-4 pt-1 text-center">
    <h3>EDIT CONSIGNEE INFORMATION</h3>
    <form id="addresslog-edit-form" class="addresslog-form" action="{{route('address-log.update', $addresslog->id)}}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="addresslog_id" value="{{$addresslog->id}}">
        <div class="form-group">
            <label>Address Alias</label>
            <input value="{{$addresslog->consignee_alias ?? ''}}" name="consignee_alias"  type="text" placeholder="e.g Consignee Name"  class="form-control">
            <div class="form-field-status form-field-consignee_alias"></div>
        </div>

        <div class="form-group">
            <label>Consignee Name</label>
            <input value="{{$addresslog->consignee_name ?? ''}}" name="consignee_name"   type="text" placeholder="Full Name"  class="form-control">
            <div class="form-field-status form-field-consignee_name"></div>
        </div>
        <div class="form-group">
            <label>Consignee Contact</label>
            <input value="{{$addresslog->consignee_contact ?? ''}}" name="consignee_number"   type="tel" placeholder="e.g 03111234567"  class="form-control">
            <div class="form-field-status form-field-consignee_number"></div>
        </div>
        <div class="form-group">
            <label>City</label>
            <select name="consignee_city"   class="form-control">
                <option value="" style="display: none">Select City</option>
                @foreach($cities as $city)
                    <option @if($city->id == $addresslog->city_id) selected="selected" @endif value="{{$city->id}}">{{$city->city_name}}</option>
                @endforeach
            </select>
            <div class="form-field-status form-field-consignee_city"></div>
        </div>
        <div class="form-group">
            <label>Consignee Address</label>
            <input value="{{$addresslog->consignee_address ?? ''}}" name="consignee_address"   type="text" placeholder="Complete Address"  class="form-control">
            <div class="form-field-status form-field-consignee_address"></div>
        </div>

        <div class="form-group">
            <label>Nearby Location (Optional)</label>
            <input value="{{$addresslog->consignee_nearby_address ?? ''}}"  name="consignee_nearby_address"  type="text" placeholder="Any nearby location if necessary"  class="form-control">
            <div class="form-field-status form-field-consignee_nearby_address"></div>
        </div>
        <div class="form-group">
            <div class="form-message"></div>
        </div>
        <div class="form-group text-center">
            <input type="submit" value="Update Consignee" class="btn btn-success btn-round btn-in-submit">
        </div>
    </form>
</div>
