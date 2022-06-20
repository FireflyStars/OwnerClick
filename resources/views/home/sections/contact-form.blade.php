<div class="section-title">
    <h2>{{__('home.get_in_touch')}}</h2>
    <p>{{__('partnership.contact_from_explain')}}</p>
</div>
<div class="contact-form">
    <form method="post" action="{{ route('contact.store') }}">
        @csrf
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert h4 text-center text-success">
                {{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
        @else
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="name" required
                               data-error="Please enter your name" placeholder="{{__('fullname')}}">
                        <div class="help-block with-errors text-lg-start">
                            @if ($errors->has('name'))
                                <div id="name-error" class="error text-danger pl-3" for="name"
                                     style="display: block;">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email" required
                               data-error="Please enter your email" placeholder="{{__('email')}}" value="{{ old('email')}}">
                        <div class="help-block with-errors text-lg-start">
                            @if ($errors->has('email'))
                                <div id="email-error" class="error text-danger pl-3" for="email"
                                     style="display: block;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <input placeholder="{{__('phone')}}" type="text" class="form-control"
                               name="phone" id="phone" value="{{ old('phone')}}" required
                               data-error="Please enter your phone number">
                        <div class="help-block with-errors text-lg-start">
                            @if ($errors->has('phone'))
                                <div id="phone-error" class="error text-danger pl-3" for="phone"
                                     style="display: block;">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <input  placeholder="{{__('subject')}}" type="text" class="form-control"
                                name="subject" id="subject" value="{{ old('subject')}}" required
                                data-error="Please enter your subject">
                        <div class="help-block with-errors text-lg-start">
                            @if ($errors->has('subject'))
                                <div id="subject-error" class="error text-danger pl-3" for="subject"
                                     style="display: block;">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                                            <textarea  class="form-control" name="message" id="message" rows="6"
                                                       placeholder="{{__('your_messages')}}"  required data-error="Please enter your message"></textarea>
                        <div class="help-block with-errors text-lg-start">
                            @if ($errors->has('message'))
                                <div id="message-error" class="error text-danger pl-3" for="message"
                                     style="display: block;">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="submit" class="default-btn"><i class='bx bx-paper-plane'></i>{{__('send')}}</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        @endif
    </form>
</div>
