<h5>Consignee: {{$addresslog->consignee_alias}}</h5>
<ul class="get-consignee-info">
    <li>Name: <span>{{$addresslog->consignee_name}}</span></li>
    <li>Address: <span>{{$addresslog->consignee_address}}</span></li>
    <li>City: <span>{{$addresslog->city->city_name}}</span></li>
    <li>Contact: <span>{{$addresslog->consignee_contact}}</span></li>
    <li>Nearby: <span>@empty($addresslog->nearby_address)  --  @else {{$addresslog->nearby_address}}  @endempty</span></li>
</ul>
