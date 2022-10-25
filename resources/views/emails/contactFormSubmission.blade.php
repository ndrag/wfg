
<h3>The following was sent from the contact form of {{ env('APP_URL')}}.</h3>

<p><b>Name:</b> {{ $formFields['first_name'] . ' ' . $formFields['last_name'] }}</p>
<p><b>Email:</b> {{ $formFields['email'] }}</p>
<p><b>Inquiry Type:</b> {{ $formFields['inquiry'] }}</p>
<p><b>Message:</b> {{ $formFields['message'] }}</p>