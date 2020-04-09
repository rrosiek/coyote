defmodule Coyote.Accounts.User do
  use Ecto.Schema
  use Pow.Ecto.Schema, password_hash_methods: {&Bcrypt.hash_pwd_salt/1, &Bcrypt.verify_pass/2}
  import Ecto.Changeset

  @cast_members [
    :receives_email,
    :last_name,
    :first_name,
    :address,
    :phone,
    :grad_year,
    :roll_number,
    :employer,
    :latitude,
    :longitude,
    :lifetime_member,
    :deceased
  ]

  schema "users" do
    field :email_verified_at, :utc_datetime
    field :receives_email, :boolean
    field :first_name, :string
    field :last_name, :string
    field :address, :string
    field :phone, :string
    field :grad_year, :integer
    field :roll_number, :integer
    field :employer, :string
    field :latitude, :decimal
    field :longitude, :decimal
    field :lifetime_member, :boolean
    field :deceased, :utc_datetime

    pow_user_fields()

    timestamps()
  end

  @doc """
  Validate a new user.
  """
  @spec create(User, Map.t()) :: Ecto.Changeset.t()
  def create(user, attrs) do
    user
    |> pow_changeset(attrs)
    |> cast(attrs, @cast_members)
    |> validate_required([
      :receives_email,
      :last_name,
      :first_name
    ])
    |> validate_common
  end

  @doc """
  Validate an existing user.
  """
  @spec update(User, Map.t()) :: Ecto.Changeset.t()
  def update(user, attrs) do
    user
    |> pow_user_id_field_changeset(attrs)
    # |> pow_current_password_changeset(attrs)
    # |> new_password_changeset(attrs, @pow_config)
    |> cast(attrs, @cast_members)
    |> validate_common
  end

  defp validate_common(changeset) do
    changeset
    |> validate_date_type(:email_verified_at)
    |> validate_inclusion(:receives_email, [true, false])
    |> validate_length(:last_name, max: 255)
    |> validate_length(:first_name, max: 255)
    |> validate_length(:address, max: 255)
    |> validate_length(:phone, max: 15)
    |> validate_number(:grad_year, greater_than: 1950)
    |> validate_number(:roll_number, greater_than: 0)
    |> validate_length(:employer, max: 255)
    |> validate_number(:latitude, greater_than_or_equal_to: -90)
    |> validate_number(:latitude, less_than_or_equal_to: 90)
    |> validate_number(:longitude, greater_than_or_equal_to: -180)
    |> validate_number(:longitude, less_than_or_equal_to: 180)
    |> validate_location
    |> validate_inclusion(:lifetime_member, [true, false])
    |> validate_date_type(:deceased)
    |> unique_constraint(:email)
  end

  defp validate_date_type(changeset, field) do
    validate_change(changeset, field, fn _, date ->
      case DateTime.from_iso8601(date) do
        {:ok, _, _} -> []
        {:error, :invalid_format} -> [{field, "is not a valid date"}]
      end
    end)
  end

  defp validate_location(
         %Ecto.Changeset{
           valid?: true,
           changes: %{address: address, latitude: %Decimal{}, longitude: %Decimal{}}
         } = changeset
       ) do
    if String.length(address) > 0 do
      changeset
    else
      add_error(changeset, :address, "does not have a valid latitude or longitude")
    end
  end

  defp validate_location(changeset), do: changeset
end
