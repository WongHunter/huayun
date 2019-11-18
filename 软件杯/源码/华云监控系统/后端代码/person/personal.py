from chinac_way_v3.core.profile.profile import Profile
from chinac_way_v3.core.client import Client
from chinac_way_v3.person.v10.personal import Personal
import json

def Person(region_id, access_key_id, access_secret):
    profile = Profile(region_id,access_key_id,access_secret)
    client = Client(profile)
    request = Personal()
    request.set_method('GET')
    # 调用旧版request.set_old_version()
    # 调用v2新版request.set_v2_version(),默认是新版
    response = client.get_response(request)
    dict = json.loads(response)
    return dict