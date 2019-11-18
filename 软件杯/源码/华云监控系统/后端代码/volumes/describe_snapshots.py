from chinac_way_v3.core.profile.profile import Profile
from chinac_way_v3.core.client import Client
from chinac_way_v3.cbs.v10.describe_snapshots import DescribeSnapshots
import json
from datebase.save_mongo import save_Mongo

def Describe_Snapshots(region_id, access_key_id, access_secret):
    profile = Profile(region_id,access_key_id,access_secret)
    client = Client(profile)
    request=DescribeSnapshots()
    request.set_method('GET')
    # 调用旧版request.set_old_version()
    # 调用v2新版request.set_v2_version(),默认是新版
    response = client.get_response(request)
    print(response)
    dict = json.loads(response)
    Action = request.get_action()
    save_Mongo(dict, Action)
    return dict
