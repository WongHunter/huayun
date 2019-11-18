from chinac_way_v3.core.profile.profile import Profile
from chinac_way_v3.core.client import Client
from chinac_way_v3.ecs.v10.run_instance import RunInstance
import json
from web.save_log import save_log

def Run_Instance(region_id, access_key_id, access_secret,image_id,instance_series,pay_type,period,instance_type,interface0network_id,volumes0type,volumes0size):
    profile = Profile(region_id,access_key_id,access_secret)
    client = Client(profile)
    request = RunInstance()
    request.set_method('GET')
    request.set_image_id(image_id)
    request.set_instance_series(instance_series)
    request.set_pay_type(pay_type)
    request.set_period(period)
    request.set_instance_type(instance_type)
    request.set_interface0network_id(interface0network_id)
    request.set_volumes0type(volumes0type)
    request.set_volumes0size(volumes0size)
    # 调用旧版request.set_old_version()
    # 调用v2新版request.set_v2_version(),默认是新版
    response = client.get_response(request)
    dict = json.loads(response)
    Action=request.get_action()
    save_log(dict,Action)
    return dict