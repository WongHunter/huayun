from chinac_way_v3.core.profile.profile import Profile
from chinac_way_v3.core.client import Client
from chinac_way_v3.ecs.v10.change_instance_firewall import ChangeInstanceFirewall
import json
from web.save_log import save_log

def Change_Instance_Firewall(region_id, access_key_id, access_secret,id,firewall_id):
    profile = Profile(region_id,access_key_id,access_secret)
    client = Client(profile)
    request = ChangeInstanceFirewall()
    request.set_method('GET')
    request.set_id(id)
    request.set_firewall_id(firewall_id)
    # 调用旧版request.set_old_version()
    # 调用v2新版request.set_v2_version(),默认是新版
    response = client.get_response(request)
    dict = json.loads(response)
    Action = request.get_action()
    save_log(dict, Action)
    return dict