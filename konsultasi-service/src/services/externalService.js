const getUserById = async (role, id) => {
    try {
        const response = await axios.get(`${process.env.USER_SERVICE_URL}/api/${role}/${id}`);
        return response.data;
    } catch (error) {
        throw new Error(`Failed to fetch ${role}: ${error.message}`);
    }
};

const getJadwalById = async (jadwalId) => {
    try {
        const response = await axios.get(`${process.env.JADWAL_SERVICE_URL}/api/jadwal/${jadwalId}`);
        return response.data;
    } catch (error) {
        throw new Error(`Failed to fetch jadwal: ${error.message}`);
    }
};

module.exports = { getUserById, getJadwalById };