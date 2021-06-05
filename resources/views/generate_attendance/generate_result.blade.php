<table>
    <thead>
    <tr>
        <th>SECTION</th>
        <th>GRADE</th>
        <th>SUBJECT</th>
        <th>STUDENT ID</th>
        <th>STUDENT NAME</th>
        <th>TIME IN</th>
        <th>DATE</th>
        <th>REMARKS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($detail as $details)
        <tr>
            <td>{{ $details['getClass']['getSection']['section']}}</td>
            <td>{{ $details['getClass']['getGrade']['grade_level'] }}</td>
            <td>{{ $details['getClass']->subject }}</td>
            <td>{{ $details['student_id'] }}</td>
            <td>{{ $details['getStudent']['f_name'].' '.$details['getStudent']['m_name'].' '.$details['getStudent']['l_name'] }}</td>
            <td>{{ $details['time_in'] }}</td>
            <td>{{ $details['date_in'] }}</td>
            @if ($details['getClass']['time_start'] < $details['time_in'])
                <td><font style="color:red;">LATE</font></td>
            @else
            <td><font style="color:blue;">ON TIME</font></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>



