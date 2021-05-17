<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('view') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('View Stock') }}</p>
                </a>
            </li>

            <li @if ($pageSlug == 'view.add') class="active " @endif>
                <a href="{{ route('addView') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Add Process') }}</p>
                </a>
            </li>
            
                
             <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                     <i class="tim-icons icon-single-02"></i>
                        <p>{{ __('User Profile') }}</p>
                </a>
            </li>
                        
                    
            
           
        </ul>
    </div>
</div>
