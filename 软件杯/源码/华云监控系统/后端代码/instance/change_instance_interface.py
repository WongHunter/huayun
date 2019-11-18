from chinac_way_v3.core.profile.profile import Profile
from chinac_way_v3.core.client import Client
from chinac_way_v3.ecs.v10.change_instance_interface import ChangeInstanceInterface
import json
from web.save_log import save_log

def Change_Instance_Interface(region_id, access_key_id, access_secret,instance_id,old_network_id,new_network_id ):
    profile = Profile(region_id,access_key_id,access_secret)
    client = Client(profile)
    request =ChangeInstanceInterface()
    request.set_method('GET')
    request.set_id(id)
    request.set_instance_id(instance_id)
    request.set_old_network_id(old_network_id)
    request.set_new_network_id(new_network_id)
    # 调用旧版request.set_old_version()
    # 调用v2新版request.set_v2_version(),默认是新版
    response = client.get_response(request)
    dict = json.loads(response)
    Action = request.get_action()
    save_log(dict, Action)
    return dict