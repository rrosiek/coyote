defmodule Coyote.Accounts.BrotherRelation do
  use Ecto.Schema
  import Ecto.Changeset

  schema "brother_relation" do
    field :little_id, :integer

    timestamps()
  end

  @doc false
  def changeset(brother_relation, attrs) do
    brother_relation
    |> cast(attrs, [:little_id])
    |> validate_required([:little_id])
  end
end
