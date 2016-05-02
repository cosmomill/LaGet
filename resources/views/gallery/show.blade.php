@extends('app')

@section('title')
    {{ $package->title }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col m8">
                <h3>{{ $package->title }} {{ $package->version }}</h3>
                <p>
                    {{ empty($package->description) ? $package->summary : $package->description }}
                </p>
                @if(config('laget.chocolatey_feed'))
                    <p>To install {{ $package->title }}, run the following command from the command line or from PowerShell:</p>
                    <div class="card teal black">
                        <div class="card-content">
                        <code class="white-text">C:\> choco install {{ $package->package_id }}</code>
                        </div>
                    </div>
                    <p>To upgrade {{ $package->title }}, run the following command from the command line or from PowerShell:</p> 
                    <div class="card teal black">
                        <div class="card-content">
                        <code class="white-text">C:\> choco upgrade {{ $package->package_id }}</code>
                        </div>
                    </div>
                @else
                    <p>To install {{ $package->title }}, run the following command in the <a href="https://docs.nuget.org/docs/start-here/using-the-package-manager-console">Package Manager Console</a>:</p>
                    <div class="card teal black">
                        <div class="card-content">
                        <code class="white-text">PM> Install-Package {{ $package->package_id }}</code>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col m4">
                <div class="img-wrapper" style="max-width: 150px;">
                    <img class="responsive-img" src="{{ $package->getIconUrl() }}" alt="{{ $package->package_id }}"/>
                </div>
                <strong>{{ $package->download_count }} downloads</strong><br/>
                <strong>{{ $package->version_download_count }} downloads of {{ $package->version }}</strong><br/>
                <strong>Last updated {{ $package->created_at->toFormattedDateString() }}</strong><br/>
                <br/>
                @if(!empty($package->project_url))
                    <a href="{{$package->project_url}}">Project Site</a><br/>
                @endif
                @if(!empty($package->license_url))
                    <a href="{{$package->license_url}}">License</a><br/>
                @endif
                <a href="{{$package->getDownloadUrl()}}">Download</a><br/>
            </div>
        </div>
        <div class="row">
            <div class="col m12">
                @if(!empty($package->release_notes))
                    <h5>Release Notes</h5>
                    <p>
                        <pre>{{ $package->release_notes }}</pre>
                    </p>
                @endif

                @if(!empty($package->getOwners()))
                    <h5>Owners</h5>
                    <ul>
                        @foreach($package->getOwners() as $owner)
                            <li>{{ $owner }}</li>
                        @endforeach
                    </ul>
                @endif
                @if(!empty($package->getAuthors()))
                    <h5>Authors</h5>
                    <ul>
                        @foreach($package->getAuthors() as $author)
                            <li>{{ $author }}</li>
                        @endforeach
                    </ul>
                @endif
                @if(!empty($package->copyright))
                    <h5>Copyright</h5>
                    <p>{{ $package->copyright }}</p>
                @endif
    
                @if(!empty($package->tags))
                    <h5>Tags</h5>
                    <p>{{ $package->tags }}</p>
                @endif

                @if(!empty($package->dependencies))
                    <h5>Dependencies</h5>
                    <ul>
                        @foreach(explode('|', $package->dependencies) as $dependency)
                            <?php $split = explode(':', $dependency); ?>
                            <li><a href="{{route('packages.show', $split[0]) }}">{{ $split[0] }}</a> (&ge; {{ $split[1] }})</li>
                        @endforeach
                    </ul>
                @endif

                <h5>Version History</h5>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>
                                Version
                            </th>
                            <th>
                                Downloads
                            </th>
                            <th>
                                Last Updated
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($versions as  $version)
                            <tr class="{{ $version->version == $package->version ? 'bold' : '' }}">
                                <td>
                                    {{ $version->version }}
                                    @if($version->version == $package->version)
                                        (this version)
                                    @endif
                                    @if($version->is_latest_version)
                                        (latest stable)
                                    @endif
                                </td>
                                <td>
                                    {{ $version->version_download_count }}
                                </td>
                                <td>
                                    {{ $version->created_at->toFormattedDateString() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection